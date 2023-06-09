<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\GajiMaster;
use App\Models\Kain_potongan;
use App\Models\Kain_roll;
use App\Models\Karyawan;
use App\Models\SPP;
use App\Models\Ukuran;
use Carbon\Carbon;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Barryvdh\DomPDF\Facade\Pdf;

class SPPController extends Controller
{
    public function index()
    {
        return view('spp.index');
    }

    public function indexData(Request $request)
    {
        $data = SPP::select('uuid', 'kode_spp', DB::raw('COUNT(*) as total'), DB::raw('DATE_FORMAT(tanggal, "%d %M %Y") as tanggal'), 'status')->groupBy('kode_spp')->get();
        return response()->json($data);
    }

    public function searchKainPotongan($ukuran)
    {
        $data = Kain_potongan::join('m_kain_rolls', 'm_kain_rolls.id', '=', 'm_kain_potongans.kain_roll_id')
            ->where('m_kain_potongans.ukuran', $ukuran)
            ->select('m_kain_potongans.*', 'm_kain_rolls.kode_lot', 'm_kain_rolls.jenis_kain', 'm_kain_rolls.warna')
            ->groupBy(['m_kain_rolls.warna', 'm_kain_rolls.jenis_kain'])
            ->get();

        return response()->json($data);
    }

    public function searchKainPotonganStok($ukuran, $kode_lot)
    {
        $data = Kain_potongan::join('m_kain_rolls', 'm_kain_rolls.id', '=', 'm_kain_potongans.kain_roll_id')
            ->where('m_kain_potongans.ukuran', $ukuran)
            ->where('m_kain_rolls.kode_lot', $kode_lot)
            ->select('m_kain_potongans.*', 'm_kain_rolls.kode_lot', 'm_kain_rolls.jenis_kain', 'm_kain_rolls.warna')
            ->first();

        return response()->json($data);
    }

    public function insert()
    {
        $kainroll   = Kain_roll::all();
        $karyawan   = Karyawan::where('posisi', 'pemotong')->get();
        $gaji       = GajiMaster::all();
        $ukuran     = Ukuran::all();
        $date       = Carbon::now()->format('Y-m-d');
        return view('spp.insert', compact(['kainroll', 'karyawan', 'gaji', 'date', 'ukuran']));
    }

    public function store(Request $request)
    {
        // try {
        $req_data   = $request->data;
        $note       = $request->notes;
        foreach ($req_data as $dt) {
            $hasil = ($dt['hasil'] == 0) ? 1 :  $dt['hasil'];
            // insert spp
            $m_kainroll = Kain_roll::where('kode_lot', $dt['nama_lot'])->first();
            $m_kainpotongan = Kain_potongan::where([
                ['kain_roll_id', $m_kainroll->id],
                ['ukuran', $dt['ukuran']]
            ])->first();
            if ($m_kainroll->stok_roll < $dt['quantity']) {
                return response()->json([
                    'code'      => 400,
                    'kode_lot'  => $m_kainroll->kode_lot,
                    'message'   => 'Gagal Menyimpan Data! Stok kurang!',
                ]);
            }
            Kain_roll::where('kode_lot', $dt['nama_lot'])->update([
                'stok_roll'     => $m_kainroll->stok_roll - $dt['quantity']
            ]);

            $k_id = [$dt['u1'], $dt['u2']];

            SPP::insert([
                'uuid'              => Uuid::uuid4()->getHex(),
                'kode_spp'          => $dt['kode_spp'],
                'kain_roll_id'      => $m_kainroll->id,
                'ukuran'            => $dt['ukuran'],
                'tanggal'           => $dt['tanggal'],
                'quantity'          => $dt['quantity'],
                'hasil_potongan'    => $dt['hasil'],
                'karyawan'          => json_encode($dt['karyawan']),
                'karyawan_id'       => json_encode($k_id),
                'gaji'              => $dt['gaji'],
                'status'            => 'Belum Konfirmasi',
                'note'              => $note,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ]);

            if ($m_kainpotongan != null || !empty($m_kainpotongan)) {
                Kain_potongan::where([
                    ['kain_roll_id', $m_kainroll->id],
                    ['ukuran', $dt['ukuran']]
                ])->update([
                    'stok'    => $m_kainpotongan->stok + $dt['hasil']
                ]);
            } else {
                Kain_potongan::insert([
                    'uuid'              => Uuid::uuid4()->getHex(),
                    'kain_roll_id'      => $m_kainroll->id,
                    'ukuran'            => $dt['ukuran'],
                    'stok'              => $dt['hasil'],
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now()
                ]);
            }

            $k1 = Karyawan::where('uuid', $dt['u1'])->first();
            $k2 = Karyawan::where('uuid', $dt['u2'])->first();

            // gaji
            if (!empty($k1)) {
                Gaji::insert([
                    [
                        'karyawan_id'       => $k1->id,
                        'kode_transaksi'    => $dt['kode_spp'],
                        'gaji'              => $dt['gaji'] * $hasil,
                        'created_at'        => Carbon::now(),
                        'updated_at'        => Carbon::now()
                    ]
                ]);
            }
            if (!empty($k2)) {
                Gaji::insert([
                    [
                        'karyawan_id'       => $k2->id,
                        'gaji'              => $dt['gaji'] * $hasil,
                        'kode_transaksi'    => $dt['kode_spp'],
                        'created_at'        => Carbon::now(),
                        'updated_at'        => Carbon::now()
                    ]
                ]);
            }
        }

        return response()->json([
            'code'      => 200,
            'message'   => 'Berhasil Menyimpan Data!!',
        ]);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'code'      => 500,
        //         'message'   => 'Error Server!',
        //         'error'     => $th
        //     ]);
        // }
    }

    public function edit($uuid)
    {
        $spp = SPP::where('uuid', $uuid)->first();
        // $spp_all = SPP::where('kode_spp', $spp->kode_spp)->get();
        $kainroll   = Kain_roll::all();
        $karyawan   = Karyawan::where('posisi', 'pemotong')->get();
        $gaji       = GajiMaster::all();
        $ukuran     = Ukuran::all();

        $get_spp = SPP::where('kode_spp', $spp->kode_spp)->get();

        for ($i = 0; $i < count($get_spp); $i++) {
            if (!empty($get_spp[$i]['kain_roll_id'])) {
                $get_kr = Kain_roll::where('id', $get_spp[$i]['kain_roll_id'])->first();
                $get_spp[$i]['kode_lot'] = $get_kr->uuid . '~' . $get_kr->kode_lot;
                $get_spp[$i]['nama_lot'] = $get_kr->kode_lot;
                $get_spp[$i]['warna'] = $get_kr->warna;
                $get_spp[$i]['ukuran_kain_potong'] = null;
            }
            if (!empty($get_spp[$i]['kain_potongan_id'])) {
                $get_kp = Kain_potongan::join('m_kain_rolls', 'm_kain_rolls.id', 'm_kain_potongans.kain_roll_id')
                    ->select('m_kain_potongans.*', 'm_kain_rolls.kode_lot', 'm_kain_rolls.warna')
                    ->where('m_kain_potongans.id', $get_spp[$i]['kain_potongan_id'])->first();
                $get_spp[$i]['nama_lot'] = $get_kp->kode_lot;
                $get_spp[$i]['warna'] = $get_kp->warna;
                $get_spp[$i]['ukuran_kain_potong'] = $get_kp->ukuran;
            }
            $get_spp[$i]['hasil'] = $get_spp[$i]['hasil_potongan'];
        }
        $spp_all = $get_spp;

        // dd($spp_all);

        return view('spp.update', ['spp' => $spp, 'spp_all' => $spp_all, 'kainroll' => $kainroll, 'karyawan' => $karyawan, 'gaji' => $gaji, 'ukuran' => $ukuran]);
    }

    public function update(Request $request)
    {
        // try {
        $req_data   = $request->data;
        $note       = $request->notes;
        foreach ($req_data as $dt) {
            $hasil = ($dt['hasil'] == 0) ? 1 :  $dt['hasil'];

            $spp = SPP::where('id', $dt['id'])->first();

            $m_kainroll = Kain_roll::where('kode_lot', $dt['nama_lot'])->first();
            $m_kainpotongan = Kain_potongan::where([
                ['kain_roll_id', $m_kainroll->id],
                ['ukuran', $dt['ukuran']]
            ])->first();
            if ($dt['quantity'] > $spp->quantity) {
                $quantity = $dt['quantity'] - $spp->quantity;
                if ($m_kainroll->stok_roll < $quantity) {
                    return response()->json([
                        'code'      => 400,
                        'kode_lot'    => $m_kainroll->kode_lot,
                        'message'   => 'Gagal Menyimpan Data! Stok kurang!',
                    ]);
                }
                Kain_roll::where('kode_lot', $dt['nama_lot'])->update([
                    'stok_roll'     => $m_kainroll->stok_roll - $quantity
                ]);
            }

            if ($dt['quantity'] < $m_kainroll->stok_roll) {
                $quantity = $spp->quantity - $dt['quantity'];
                Kain_roll::where('kode_lot', $dt['nama_lot'])->update([
                    'stok_roll'     => $m_kainroll->stok_roll + $quantity
                ]);
            }

            $k_id = [$dt['u1'], $dt['u2']];

            SPP::where([
                ['id', $dt['id']],
                ['kode_spp', $dt['kode_spp']]
            ])->update([
                'ukuran'            => $dt['ukuran'],
                'kain_roll_id'      => $m_kainroll->id,
                'tanggal'           => $dt['tanggal'],
                'quantity'          => $dt['quantity'],
                'hasil_potongan'    => $dt['hasil'],
                'karyawan'          => json_encode($dt['karyawan']),
                'karyawan_id'       => json_encode($k_id),
                'gaji'              => $dt['gaji'],
                'note'              => $note,
                'updated_at'        => Carbon::now()
            ]);

            if ($m_kainpotongan != null || !empty($m_kainpotongan)) {
                Kain_potongan::where([
                    ['kain_roll_id', $m_kainroll->id],
                    ['ukuran', $dt['ukuran']]
                ])->update([
                    'stok'    => $m_kainpotongan->stok + $dt['hasil']
                ]);
            } else {
                Kain_potongan::insert([
                    'uuid'              => Uuid::uuid4()->getHex(),
                    'kain_roll_id'      => $m_kainroll->id,
                    'stok'              => $dt['hasil'],
                    'ukuran'            => $dt['ukuran'],
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now()
                ]);
            }

            $k1 = Karyawan::where('uuid', $dt['u1'])->first();
            $k2 = Karyawan::where('uuid', $dt['u2'])->first();

            if (!empty($k1) && $dt['gaji'] !== $spp->gaji) {
                Gaji::where([
                    ['karyawan_id', $k1->id],
                    ['kode_transaksi', $dt['kode_spp']]
                ])->update([
                    'gaji'          => $dt['gaji'] * $hasil,
                    'updated_at'        => Carbon::now()
                ]);
            }
            if (!empty($k2) && $dt['gaji'] !== $spp->gaji) {
                Gaji::where([
                    ['karyawan_id', $k2->id],
                    ['kode_transaksi', $dt['kode_spp']]
                ])->update([
                    'gaji'          => $dt['gaji'] * $hasil,
                    'updated_at'        => Carbon::now()
                ]);
            }


            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Menyimpan Data!!',
            ]);
            // } catch (\Exception $th) {
            //     return response()->json([
            //         'code'      => 500,
            //         'message'   => 'Error Server!',
            //         'error'     => $th
            //     ]);
            // }
        }
    }

    public function destroy($kode_spp)
    {
        try {
            $spp = SPP::where('kode_spp', $kode_spp)->get();
            foreach ($spp as $dt) {
                if ($dt->kain_roll_id !== null) {
                    $m_kainroll = Kain_roll::where('id', $dt->kain_roll_id)->first();
                    $m_kainpotongan = Kain_potongan::where('kain_roll_id', $dt->kain_roll_id)->first();

                    $k_spp = json_decode($dt->karyawan_id);
                    // update stok kain roll
                    Kain_roll::where('id', $dt->kain_roll_id)->update([
                        'stok_roll'     => $m_kainroll->stok_roll + $dt->quantity
                    ]);

                    //  update stok kain potongan
                    Kain_potongan::where([
                        ['kain_roll_id', $dt->kain_roll_id],
                        ['ukuran', $dt->ukuran]
                    ])->update([
                        'stok'    => $m_kainpotongan->stok - $dt->hasil_potongan
                    ]);

                    Gaji::where('kode_transaksi', $dt->kode_spp)->delete();
                    SPP::where('id', $dt->id)->delete();
                } elseif ($dt->kain_potongan_id !== null) {
                    $m_kainpotongan = Kain_potongan::where('id', $dt->kain_potongan_id)->first();

                    $k_spp = json_decode($dt->karyawan_id);
                    // update stok kain potongan yang dipotong
                    Kain_potongan::where('id', $dt->kain_potongan_id)->update([
                        'stok'     => $m_kainpotongan->stok + $dt->quantity
                    ]);

                    //  update stok kain potongan hasil
                    Kain_potongan::where([
                        ['kain_roll_id', $m_kainpotongan->kain_roll_id],
                        ['ukuran', $dt->ukuran]
                    ])->update([
                        'stok'    => $m_kainpotongan->stok - $dt->hasil_potongan
                    ]);

                    Gaji::where('kode_transaksi', $dt->kode_spp)->delete();
                    SPP::where('id', $dt->id)->delete();
                } else {

                    return response()->json([
                        'code'      => 500,
                        'message'   => 'Error',
                    ]);
                }
            }

            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Hapus data SPP',
            ]);

            // $ukuran = Ukuran::all();

            // return view('ukuran.index', $ukuran);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Hapus data SPP!',
                'error'     => $th
            ]);
        }
    }

    public function confirm($kode_spp)
    {
        try {
            SPP::where('kode_spp', $kode_spp)->update([
                'status' => 'Sedang Dikerjakan'
            ]);

            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Konfirmasi Data SPP!',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Konfirmasi Data SPP!',
                'error'     => $th
            ]);
        }
    }

    public function finished($kode_spp)
    {
        try {
            SPP::where('kode_spp', $kode_spp)->update([
                'status' => 'Selesai Dikerjakan'
            ]);

            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Konfirmasi Data SPP!',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Konfirmasi Data SPP!',
                'error'     => $th
            ]);
        }
    }

    public function dataSPP($kode_spp)
    {
        $spp = SPP::query()
            ->join('m_kain_rolls', function ($query) {
                $query->on('m_kain_rolls.id', '=', 't_spps.kain_roll_id');
            })
            ->where('kode_spp', $kode_spp)
            ->get();
        return response()->json($spp);
    }

    public function cetakPdf($uuid){
        $spp = SPP::where('uuid', $uuid)->first();
        $dataSpp = DB::select("
            SELECT spp.ukuran, spp.quantity, spp.hasil_potongan, spp.karyawan, spp.note, kr.kode_lot, CONCAT(kr.jenis_kain, ' | ', kr.warna) as jenis
            FROM t_spps spp, m_kain_rolls kr
            WHERE spp.kain_roll_id = kr.id
        ");
        $no = 1;

        $pdf = Pdf::loadView('spp.pdf.index', compact(['spp', 'dataSpp', 'no']));
        return $pdf->stream('Cetak SPP - '.$spp->kode_spp);
    }
}
