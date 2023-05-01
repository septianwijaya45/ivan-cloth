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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

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

    public function insert()
    {
        $kainroll   = Kain_roll::all();
        $karyawan   = Karyawan::where('posisi', 'pemotong')->get();
        $gaji       = GajiMaster::all();
        $ukuran     = Ukuran::all();
        $date = Carbon::now()->format('Y-m-d');
        return view('spp.insert', compact(['kainroll', 'karyawan', 'gaji', 'date', 'ukuran']));
    }

    public function store(Request $request)
    {
        try {
            $req_data   = $request->data;
            $note       = $request->notes;
            foreach($req_data as $dt){
                $hasil = ($dt['hasil'] == 0) ? 1 :  $dt['hasil'];
                // insert spp
                $m_kainroll = Kain_roll::where('kode_lot', $dt['nama_lot'])->first();
                $m_kainpotongan = Kain_potongan::where([
                    ['kain_roll_id', $m_kainroll->id],
                    ['ukuran', $dt['ukuran']]
                ])->first();
                if($m_kainroll->berat < $dt['berat']){
                    return response()->json([
                        'code'      => 400,
                        'kode_lot'    => $m_kainroll->kode_lot,
                        'message'   => 'Gagal Menyimpan Data! Stok kurang!',
                    ]);
                }
                Kain_roll::where('kode_lot', $dt['nama_lot'])->update([
                    'berat'     => $m_kainroll->berat - $dt['berat']
                ]);
                
                $k_id = [$dt['u1'], $dt['u2']];
    
                SPP::insert([
                    'uuid'              => Uuid::uuid4()->getHex(),
                    'kode_spp'          => $dt['kode_spp'],
                    'ukuran'            => $dt['ukuran'],
                    'kain_roll_id'      => $m_kainroll->id,
                    'tanggal'           => $dt['tanggal'],
                    'berat'             => $dt['berat'],
                    'hasil_potongan'    => $dt['hasil'],
                    'karyawan'          => json_encode($dt['karyawan']),
                    'karyawan_id'       => json_encode($k_id),
                    'gaji'              => $dt['gaji'],
                    'status'            => 'Belum Konfirmasi',
                    'note'              => $note,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now()
                ]);

                if($m_kainpotongan != null || !empty($m_kainpotongan)){
                    Kain_potongan::where([
                        ['kain_roll_id', $m_kainroll->id],
                        ['ukuran', $dt['ukuran']]
                    ])->update([
                        'stok'    => $m_kainpotongan->stok + $dt['hasil']
                    ]);
                }else{
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
                if(!empty($k1)){
                    Gaji::insert([
                        [
                            'karyawan_id'   => $k1->id,
                            'kode_transaksi'    => $dt['kode_spp'],
                            'gaji'          => $dt['gaji'] * $hasil,
                            'created_at'        => Carbon::now(),
                            'updated_at'        => Carbon::now()
                        ]
                    ]);
                }
                if(!empty($k2)){
                    Gaji::insert([
                        [
                            'karyawan_id'   => $k2->id,
                            'gaji'          => $dt['gaji'] * $hasil,
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
        } catch (\Exception $th) {
            return response()->json([
                'code'      => 500,
                'message'   => 'Error Server!',
                'error'     => $th
            ]);
        }
    }

    public function edit($uuid)
    {
        $spp = SPP::where('uuid', $uuid)->first();
        // $spp_all = SPP::where('kode_spp', $spp->kode_spp)->get();
        $kainroll   = Kain_roll::all();
        $karyawan   = Karyawan::where('posisi', 'pemotong')->get();
        $gaji       = GajiMaster::all();
        $ukuran     = Ukuran::all();

        $spp_all = DB::select("
            SELECT spp.*, kd.uuid, kd.kode_lot as nama_lot, kd.warna, spp.hasil_potongan as hasil
            FROM t_spps spp, m_kain_rolls kd
            WHERE spp.kode_spp = '$spp->kode_spp' AND spp.kain_roll_id = kd.id 
        ");
        // dd($spp_all);
        
        return view('spp.update', ['spp' => $spp, 'spp_all' => $spp_all, 'kainroll' => $kainroll, 'karyawan' => $karyawan, 'gaji' => $gaji,'ukuran' => $ukuran]);
    }

    public function update(Request $request)
    {
        try {
            $req_data   = $request->data;
            $note       = $request->notes;
            foreach($req_data as $dt){
                $hasil = ($dt['hasil'] == 0) ? 1 :  $dt['hasil'];
                $spp = SPP::where('kode_spp', $dt['kode_spp'])->first();
                $m_kainroll = Kain_roll::where('kode_lot', $dt['nama_lot'])->first();
                $m_kainpotongan = Kain_potongan::where([
                    ['kain_roll_id', $m_kainroll->id],
                    ['ukuran', $dt['ukuran']]
                ])->first();
                if($dt['berat'] > $spp->berat){
                    $berat = $dt['berat'] - $spp->berat;
                    if($m_kainroll->berat < $berat){
                        return response()->json([
                            'code'      => 400,
                            'kode_lot'    => $m_kainroll->kode_lot,
                            'message'   => 'Gagal Menyimpan Data! Stok kurang!',
                        ]);
                    }
                    Kain_roll::where('kode_lot', $dt['nama_lot'])->update([
                        'berat'     => $m_kainroll->berat - $berat
                    ]);
                }

                if($dt['berat'] < $m_kainroll->berat){
                    $berat = $spp->berat - $dt['berat'];
                    Kain_roll::where('kode_lot', $dt['nama_lot'])->update([
                        'berat'     => $m_kainroll->berat + $berat
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
                    'berat'             => $dt['berat'],
                    'hasil_potongan'    => $dt['hasil'],
                    'karyawan'          => json_encode($dt['karyawan']),
                    'karyawan_id'       => json_encode($k_id),
                    'gaji'              => $dt['gaji'],
                    'note'              => $note,
                    'updated_at'        => Carbon::now()
                ]);

                if($m_kainpotongan != null || !empty($m_kainpotongan)){
                    Kain_potongan::where([
                        ['kain_roll_id', $m_kainroll->id],
                        ['ukuran', $dt['ukuran']]
                    ])->update([
                        'stok'    => $m_kainpotongan->stok + $dt['hasil']
                    ]);
                }else{
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

                if(!empty($k1) && $dt['gaji'] !== $spp->gaji){
                    Gaji::where([
                        ['karyawan_id', $k1->id],
                        ['kode_transaksi', $dt['kode_spp']]
                    ])->update([
                            'gaji'          => $dt['gaji'] * $hasil,
                            'updated_at'        => Carbon::now()
                    ]);
                }
                if(!empty($k2) && $dt['gaji'] !== $spp->gaji){
                    Gaji::where([
                        ['karyawan_id', $k2->id],
                        ['kode_transaksi', $dt['kode_spp']]
                    ])->update([
                            'gaji'          => $dt['gaji'] * $hasil,
                            'updated_at'        => Carbon::now()
                    ]);
                }
            }
            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Menyimpan Data!!',
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'code'      => 500,
                'message'   => 'Error Server!',
                'error'     => $th
            ]);
        }
    }

    public function destroy($kode_spp)
    {
        try {
            $spp = SPP::where('kode_spp', $kode_spp);
            $m_kainroll = Kain_roll::where('id', $spp->value('kain_roll_id'))->first();
            $m_kainpotongan = Kain_potongan::where([
                ['kain_roll_id', $spp->value('kain_roll_id')],
                ['ukuran', $spp->value('ukuran')]
            ])->first();
            
            if($spp !== null && $m_kainroll !== null){
                $dt_spp = $spp->first();
                $k_spp = json_decode($dt_spp->karyawan_id);
                // update stok kain roll
                Kain_roll::where('id', $dt_spp->kain_roll_id)->update([
                    'berat'     => $m_kainroll->berat + $dt_spp->berat
                ]);

                //  update stok kain potongan
                Kain_potongan::where([
                    ['kain_roll_id', $dt_spp->kain_roll_id],
                    ['ukuran', $dt_spp->ukuran]
                ])->update([
                    'stok'    => $m_kainpotongan->stok - $dt_spp->hasil_potongan
                ]);

                Gaji::where('kode_transaksi', $dt_spp->kode_spp)->delete();
                $spp->delete();
            }
            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Hapus data SPP',
            ]);

            $ukuran = Ukuran::all();
        
            return view('ukuran.index',$ukuran);
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
        ->join('m_kain_rolls', function($query){
            $query->on('m_kain_rolls.id', '=', 't_spps.kain_roll_id');
        })
        ->where('kode_spp', $kode_spp)
        ->get();
        return response()->json($spp);
    }
}
