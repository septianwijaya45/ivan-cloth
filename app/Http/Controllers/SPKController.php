<?php

namespace App\Http\Controllers;

use App\Models\FileSPK;
use App\Models\Gaji;
use App\Models\GajiMaster;
use App\Models\Kain_potongan;
use App\Models\Kain_roll;
use App\Models\Kain_tersablon;
use App\Models\Karyawan;
use App\Models\SPK;
use App\Models\SPKDetail;
use App\Models\SPP;
use File;
use App\Models\Ukuran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class SPKController extends Controller
{
    public function getArtikel($model)
    {
        $randNum = rand();
        $artikel = $model . '' . $randNum;

        $checkArticel = SPK::where('artikel', $artikel)->first();
        while ($checkArticel) {
            $randNum = rand();
            $artikel = $model . '' . $randNum;
        }

        $kp = Kain_potongan::join('m_kain_rolls', 'm_kain_rolls.id', '=', 'm_kain_potongans.kain_roll_id')
            ->where('m_kain_potongans.ukuran', $model)
            ->select('m_kain_potongans.*', 'm_kain_rolls.kode_lot', 'm_kain_rolls.jenis_kain', 'm_kain_rolls.warna')
            ->groupBy(['m_kain_rolls.warna', 'm_kain_rolls.jenis_kain'])
            ->get();

        return response()->json([
            'model'     => $model,
            'artikel'   => $artikel,
            'kp'        => $kp
        ]);
    }

    public function getHasilPotongan($kp_id)
    {
        $hasil = Kain_potongan::where('id', $kp_id)->first();
        return response()->json($hasil);
    }

    public function index()
    {
        return view('spk.index');
    }

    public function indexData()
    {
        $data = SPK::select('uuid', 'kode_spk', DB::raw('COUNT(*) as total'), DB::raw('DATE_FORMAT(tanggal, "%d %M %Y") as tanggal'), 'status')->groupBy('kode_spk')->get();
        return response()->json($data);
    }

    public function insert()
    {
        $ukuran     = Ukuran::all();
        $karyawan   = Karyawan::where('posisi', 'sablon')->get();
        $gaji       = GajiMaster::all();

        $date = Carbon::now()->format('Y-m-d');
        return view('spk.insert', compact(['ukuran', 'karyawan', 'gaji', 'date']));
    }

    public function store(Request $request)
    {
        $req_data   = $request->data;
        $note       = $request->notes;

        foreach ($req_data as $dt) {
            $quantity = ($dt['quantity'] == 0) ? 1 : $dt['quantity'];
            $kp = Kain_potongan::where('id', $dt['kp_id'])->first();
            if ($kp->stok < $dt['quantity']) {
                return response()->json([
                    'code'      => 400,
                    'ID'        => $kp->id,
                    'message'   => 'Gagal Menyimpan Data! Stok kurang!',
                ]);
            }
            Kain_potongan::where('id', $dt['kp_id'])->update([
                'stok'    => $kp->stok - $dt['quantity']
            ]);

            $k_id = [$dt['karyawan'][0], $dt['karyawan'][1]];
            
            $k1 = Karyawan::where('uuid', $dt['karyawan'][0])->first();
            $k2 = Karyawan::where('uuid', $dt['karyawan'][1])->first();
            

            $checkSpk = SPK::where('kode_spk', $dt['kode_spk'])->where('artikel', $dt['artikel'])->first();

            if(!$checkSpk){
                $spk = new SPK();
                $spk->uuid          = Uuid::uuid4()->getHex();
                $spk->kode_spk      = $dt['kode_spk'];
                $spk->artikel       = $dt['artikel'];
                $spk->tanggal       = $dt['tanggal'];
                $spk->ukuran        = $dt['ukuran'];
                $spk->note          = $note;
                $spk->status        = 'Belum Konfirmasi';
                $spk->created_at    = Carbon::now();
                $spk->updated_at    = Carbon::now();
                $spk->save();

                SPKDetail::insert([
                    't_spk_id'              => $spk->id,
                    'kode_spk'              => $dt['kode_spk'],
                    'kain_potongan_id'      => $dt['kp_id'],
                    'quantity'              => $dt['quantity'],
                    'satuan'                => $dt['satuan'],
                    'karyawan_id'           => json_encode($k_id),
                    'karyawan'              => json_encode($dt['nama_karyawan']),
                    'gaji'                  => $dt['gaji']
                ]);
            }else{
                SPKDetail::insert([
                    't_spk_id'              => $checkSpk->id,
                    'kode_spk'              => $dt['kode_spk'],
                    'kain_potongan_id'      => $dt['kp_id'],
                    'quantity'              => $dt['quantity'],
                    'satuan'                => $dt['satuan'],
                    'karyawan_id'           => json_encode($k_id),
                    'karyawan'              => json_encode($dt['nama_karyawan']),
                    'gaji'                  => $dt['gaji']
                ]);
            }


            // gaji
            if (!empty($k1)) {
                Gaji::insert([
                    [
                        'karyawan_id'   => $k1->id,
                        'kode_transaksi'    => $dt['kode_spk'],
                        'gaji'          => $dt['gaji'] * $quantity,
                        'created_at'        => Carbon::now(),
                        'updated_at'        => Carbon::now()
                    ]
                ]);
            }
            if (!empty($k2)) {
                Gaji::insert([
                    [
                        'karyawan_id'   => $k2->id,
                        'kode_transaksi'    => $dt['kode_spk'],
                        'gaji'          => $dt['gaji'] * $quantity,
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
    }

    public function storeGambar(Request $request)
    {
        $validate = $request->validate([
            'gambar' => 'required',
            'gambar.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if (!$validate) {
            return response()->json([
                'code'      => 400,
                'title'     => 'Gagal Menyimpan Gambar!',
                'message'   => 'Gambar Harus Kurang dari 2 MB atau tipe gambar harus jpeg,png,jpg,gif,svg'
            ]);
        }

        if ($request->hasfile('gambar')) {
            foreach ($request->gambar as $image) {
                $name = time() . rand(1, 100) . '.' . $image->extension();
                if ($image->move(public_path('img/gambar/'), $name)) {
                    FileSPK::create([
                        'uuid'      => Uuid::uuid4()->getHex(),
                        'kode_spk'  => $request->kode_spk,
                        'nama_foto' => $name,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }
            }
        }

        return response()->json([
            'code'      => 200,
            'message'   => 'Berhasil Menyimpan Data!!',
        ]);
    }

    public function edit($uuid)
    {
        $spk = SPK::where('uuid', $uuid)->first();
        $kainroll   = Kain_roll::all();
        $karyawan   = Karyawan::where('posisi', 'sablon')->get();
        $gaji       = GajiMaster::all();
        $ukuran     = Ukuran::all();

        $spkDetail = SPKDetail::select('t_spk_details.*', 'm_kain_potongans.id as id_kp', DB::raw('CONCAT(m_kain_rolls.jenis_kain, " | ", m_kain_rolls.warna) as nama_kain_roll'), 'm_kain_rolls.stok_roll')
                    ->join('m_kain_potongans', 'm_kain_potongans.id', '=', 't_spk_details.kain_potongan_id')
                    ->join('m_kain_rolls', 'm_kain_rolls.id', '=', 'm_kain_potongans.kain_roll_id')
                    ->where('kode_spk', $spk->kode_spk)
                    ->get();

        $gambarSpk = FileSPK::where('kode_spk', $spk->kode_spk)->get();

        return view('spk.update', compact(['spk', 'spkDetail', 'kainroll', 'karyawan', 'gaji', 'ukuran', 'gambarSpk']));
    }

    public function update(Request $request)
    {
        // try {
        $req_data   = $request->data;
        $note       = $request->notes;
        foreach ($req_data as $dt) {
            // dd($dt);

            $checkSPK = SPK::where([
                ['artikel', $dt['artikel']],
                ['ukuran', $dt['ukuran']],
                ['kode_spk', $dt['kode_spk']],
            ])->first();
            if (!empty($checkSPK)) {

                $hasil = ($dt['jumlah_kain'] == 0) ? 1 : $dt['jumlah_kain'];
                $spk = SPK::where('kode_spp', $dt['kode_spp'])->first();
                $id_kr = SPP::where([
                    ['kode_spp', $dt['kode_spp']],
                    ['ukuran', $dt['ukuran']]
                ])->value('kain_roll_id');
                $kp = Kain_potongan::where('kain_roll_id', $id_kr)->first();
                $kr = Kain_roll::where('id', $id_kr)->first();
                if ($kp->ukuran < $dt['kain_potongan_dipakai']) {
                    return response()->json([
                        'code'      => 400,
                        'kode_lot'    => $kr->kode_lot,
                        'message'   => 'Gagal Menyimpan Data! Stok kurang!',
                    ]);
                }

                if ($dt['kain_potongan_dipakai'] != $spk->kain_potongan_dipakai) {
                    if ($dt['kain_potongan_dipakai'] < $spk->kain_potongan_dipakai) {
                        $stok = $spk->kain_potongan_dipakai - $dt['kain_potongan_dipakai'];
                        Kain_potongan::where('kain_roll_id', $id_kr)->update([
                            'stok'    => $kp->stok + $stok
                        ]);
                    }
                    if ($dt['kain_potongan_dipakai'] > $spk->kain_potongan_dipakai) {
                        $stok = $dt['kain_potongan_dipakai'] - $spk->kain_potongan_dipakai;
                        Kain_potongan::where('kain_roll_id', $id_kr)->update([
                            'stok'    => $kp->stok - $stok
                        ]);
                    }
                }

                // $karyawan_id = [$dt['u1'], $dt['u2']];

                SPK::where('id', $dt['id'])
                    ->where('kode_spk', $dt['kode_spk'])
                    ->update([
                        'kode_spp'          => $dt['kode_spp'],
                        'kain_potongan_id'  => $kp->id,
                        'artikel'           => $dt['artikel'],
                        'tanggal'           => $dt['tanggal'],
                        'karyawan_id'       => $dt['karyawan_id'],
                        // 'karyawan_id'       => json_encode($karyawan_id),
                        'karyawan'          => $dt['karyawan'],
                        'kain_potongan_dipakai' => $dt['kain_potongan_dipakai'],
                        'jumlah_kain'       => $dt['jumlah_kain'],
                        'satuan'            => $dt['satuan'],
                        'ukuran'            => $dt['ukuran'],
                        'gaji'              => $dt['gaji'],
                        'note'              => $note,
                        'status'            => 'Belum Konfirmasi',
                        'updated_at'        => Carbon::now()
                    ]);


                if (is_array($dt['karyawan_id'])) {
                    $idKaryawan = $dt['karyawan_id'];
                } else {
                    $idKaryawan = json_decode($dt['karyawan_id']);
                }

                // dd([$idKaryawan, $dt['karyawan_id']]);
                $k1 = Karyawan::where('uuid', $idKaryawan[0])->first();
                $k2 = Karyawan::where('uuid', $idKaryawan[1])->first();
                // gaji
                if (!empty($k1)) {
                    Gaji::where('karyawan_id', $k1->id)
                        ->where('kode_transaksi', $dt['kode_spp'])
                        ->update([
                            'gaji'          => $dt['gaji'] * $hasil,
                            'updated_at'        => Carbon::now()
                        ]);
                }
                if (!empty($k2)) {
                    Gaji::where('karyawan_id', $k2->id)
                        ->where('kode_transaksi', $dt['kode_spp'])
                        ->update([
                            'gaji'          => $dt['gaji'] * $hasil,
                            'updated_at'        => Carbon::now()
                        ]);
                }
            }

            if (empty($checkSPK)) {
                $hasil = ($dt['jumlah_kain'] == 0) ? 1 : $dt['jumlah_kain'];
                $id_kr = SPP::where([
                    ['kode_spp', $dt['kode_spp']],
                    ['ukuran', $dt['ukuran']]
                ])->value('kain_roll_id');
                $kp = Kain_potongan::where('kain_roll_id', $id_kr)->first();
                $kr = Kain_roll::where('id', $id_kr)->first();
                if ($kp->ukuran < $dt['kain_potongan_dipakai']) {
                    return response()->json([
                        'code'      => 400,
                        'kode_lot'    => $kr->kode_lot,
                        'message'   => 'Gagal Menyimpan Data! Stok kurang!',
                    ]);
                }
                Kain_potongan::where('kain_roll_id', $id_kr)->update([
                    'stok'    => $kp->stok - $dt['kain_potongan_dipakai']
                ]);

                $karyawan_id = [$dt['u1'], $dt['u2']];

                SPK::insert([
                    'uuid'              => Uuid::uuid4()->getHex(),
                    'kode_spp'          => $dt['kode_spp'],
                    'kode_spk'          => $dt['kode_spk'],
                    'kain_potongan_id'  => $kp->id,
                    'artikel'           => $dt['artikel'],
                    'tanggal'           => $dt['tanggal'],
                    'karyawan_id'       => json_encode($karyawan_id),
                    'karyawan'          => json_encode($dt['karyawan']),
                    'kain_potongan_dipakai' => $dt['kain_potongan_dipakai'],
                    'jumlah_kain'       => $dt['jumlah_kain'],
                    'satuan'            => $dt['satuan'],
                    'ukuran'            => $dt['ukuran'],
                    'gaji'              => $dt['gaji'],
                    'note'              => $note,
                    'status'            => 'Belum Konfirmasi',
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now()
                ]);

                $k1 = Karyawan::where('uuid', $dt['u1'])->first();
                $k2 = Karyawan::where('uuid', $dt['u2'])->first();

                // gaji
                if (!empty($k1)) {
                    Gaji::insert([
                        [
                            'karyawan_id'   => $k1->id,
                            'kode_transaksi'    => $dt['kode_spk'],
                            'gaji'          => $dt['gaji'] * $hasil,
                            'created_at'        => Carbon::now(),
                            'updated_at'        => Carbon::now()
                        ]
                    ]);
                }
                if (!empty($k2)) {
                    Gaji::insert([
                        [
                            'karyawan_id'   => $k2->id,
                            'kode_transaksi'    => $dt['kode_spk'],
                            'gaji'          => $dt['gaji'] * $hasil,
                            'created_at'        => Carbon::now(),
                            'updated_at'        => Carbon::now()
                        ]
                    ]);
                }
            }
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

    public function updateDetail(Request $request)
    {
        try {
            $reqData    = $request->data;
            $note       = $request->notes;

            foreach($reqData as $dt){
                $kp = Kain_potongan::where('kain_roll_id', $dt['kp_ide'])->first();
                $kr = Kain_roll::where('id', $kp->kain_roll_id)->first();

                $splitK1 = explode('-', $dt['k1e']);
                $splitK2 = explode('-', $dt['k2e']);

                $k_id = [$splitK1[0], $splitK2[0]];
                $k_nama = [$splitK1[1], $splitK2[1]];

                $checkQuantity = SPKDetail::where('id', $dt['ide'])->first();

                if ($kp->ukuran < $dt['quantitye']) {
                    return response()->json([
                        'code'      => 400,
                        'kode_lot'    => $kr->kode_lot,
                        'message'   => 'Gagal Menyimpan Data! Stok kurang!',
                    ]);
                }

                if($dt['quantitye'] !== $checkQuantity->quantity){
                    if($dt['quantitye'] < $checkQuantity->quantity){
                        $stok = $checkQuantity->quantity - $dt['quantitye'];
                        Kain_potongan::where('kain_roll_id', $dt['kp_ide'])->update([
                            'stok'    => $kp->stok + $stok
                        ]);
                    }

                    if($dt['quantitye'] > $checkQuantity->quantity){
                        $stok =$dt['quantitye'] - $checkQuantity->quantity;
                        Kain_potongan::where('kain_roll_id', $dt['kp_ide'])->update([
                            'stok'    => $kp->stok + $stok
                        ]);
                    }
                }

                SPK::where('kode_spk', $checkQuantity->kode_spk)->update([
                    'note'  => $note
                ]);

                SPKDetail::where('id', $dt['ide'])->update([
                    'kain_potongan_id'      => $dt['kp_ide'],
                    'quantity'              => $dt['quantitye'],
                    'satuan'                => $dt['satuane'],
                    'karyawan_id'           => json_encode($k_id),
                    'karyawan'              => json_encode($k_nama)
                ]);
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

    public function confirm($kode_spk)
    {
        try {
            SPK::where('kode_spk', $kode_spk)->update([
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

    public function finished($kode_spk)
    {
        try {
            SPK::where('kode_spk', $kode_spk)->update([
                'status' => 'Selesai Dikerjakan'
            ]);

            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Konfirmasi Data SPK!',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Konfirmasi Data SPK!',
                'error'     => $th
            ]);
        }
    }

    public function destroy($kode_spk)
    {
        $spk = SPK::where('kode_spk', $kode_spk);

        if ($spk !== null) {
            $dt_spk = $spk->first();

            //  update stok kain potongan
            $kain_potongan_id = json_decode($dt_spk->kain_potongan_id);
            $quantity = json_decode($dt_spk->quantity);
            for ($i = 0; $i < count($kain_potongan_id); $i++) {
                $m_kainpotongan = Kain_potongan::where('id', $kain_potongan_id[$i])->first();

                Kain_potongan::where('id', $kain_potongan_id[$i])->update([
                    'stok'    => $m_kainpotongan->stok + $quantity[$i]
                ]);
            }

            Gaji::where('kode_transaksi', $dt_spk->kode_spp)->delete();
            $spk->delete();

            $image = FileSPK::where('kode_spk', $kode_spk)->value('nama_foto');
            File::delete('img/gambar/' . $image);
            FileSPK::where('kode_spk', $kode_spk)->delete();

            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Hapus data SPK',
            ]);
        }
    }

    public function destroyImage($uuid)
    {
        try {
            $fileImageSpk = FileSPK::where('uuid', $uuid);
            if ($fileImageSpk) {
                $image = $fileImageSpk->value('nama_foto');
                File::delete('img/gambar/' . $image);
                $fileImageSpk->delete();
                return response()->json([
                    'code'      => 200,
                    'message'   => 'Berhasil Hapus data Gambar SPK',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Hapus data SPK!',
                'error'     => $th
            ]);
        }
    }

    public function destroyDetail($id)
    {
        try {
            $spk = SPKDetail::where('id', $id);
            $m_kainpotongan = Kain_potongan::where('id', $spk->value('kain_potongan_id'))->first();

            if ($spk !== null & $m_kainpotongan !== null) {
                $dt_spk = $spk->first();

                //  update stok kain potongan
                Kain_potongan::where('kain_roll_id', $dt_spk->kain_roll_id)->update([
                    'stok'    => $m_kainpotongan->stok + $dt_spk->quantity
                ]);

                Gaji::where('kode_transaksi', $dt_spk->kode_spp)->delete();
                $spk->delete();

                return response()->json([
                    'code'      => 200,
                    'message'   => 'Berhasil Hapus data Detail SPK',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Hapus data SPK!',
                'error'     => $th
            ]);
        }
    }
}
