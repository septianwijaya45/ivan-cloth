<?php

namespace App\Http\Controllers;

use App\Models\FileSPK;
use App\Models\Gaji;
use App\Models\GajiMaster;
use App\Models\Kain_potongan;
use App\Models\Kain_roll;
use App\Models\Karyawan;
use App\Models\SPK;
use App\Models\SPP;
use App\Models\Ukuran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class SPKController extends Controller
{
    public function getArtikel($model){
        $count = strlen($model);
        if($count > 1){
            $model = substr($model, 0);
        }
        
        $randNum = rand();
        $artikel = $model.''.$randNum;
    
        $checkArticel = SPK::where('artikel', $artikel)->first();
        while($checkArticel){
            $randNum = rand();
            $artikel = $model.''.$randNum;
        }
        return response()->json($artikel);
    }

    public function getHasilPotongan($kode_spp, $ukuran, $warna)
    {
        $spp = SPP::select('kain_roll_id', DB::raw('SUM(hasil_potongan) as hasilspp'))->where([
            ['kode_spp', $kode_spp],
            ['ukuran', $ukuran]
        ])->groupBy('kode_spp', 'ukuran')->first();
        $hasil = Kain_potongan::where('id', $spp->kain_roll_id)->first();
        return response()->json([
            'spp'   => $spp,
            'hasil' => $hasil
        ]);
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
        $ukuran = Ukuran::all();
        $karyawan   = Karyawan::where('posisi', 'sablon')->get();
        $gaji       = GajiMaster::all();
        $spp        = SPP::select('kode_spp')
                        ->groupBy('kode_spp')
                        ->get();
        $date = Carbon::now()->format('Y-m-d');
        return view('spk.insert', compact(['ukuran', 'karyawan', 'gaji', 'spp', 'date']));
    }

    public function store(Request $request)
    {
        $req_data   = $request->data;
        $note       = $request->notes;
        foreach($req_data as $dt){
            $hasil = ($dt['hasil'] == 0) ? 1 : $dt['hasil'];
            $id_kr = SPP::where([
                ['kode_spp', $dt['kode_spp']],
                ['ukuran', $dt['ukuran']]
            ])->value('kain_roll_id');
            $kp = Kain_potongan::where('kain_roll_id', $id_kr)->first();
            $kr = Kain_roll::where('id', $id_kr)->first();
            if($kp->ukuran < $dt['kain_potongan_dipakai']){
                return response()->json([
                    'code'      => 400,
                    'kode_lot'    => $kr->kode_lot,
                    'message'   => 'Gagal Menyimpan Data! Stok kurang!',
                ]);
            }
            Kain_potongan::where('kain_roll_id', $id_kr)->update([
                'ukuran'    => $kp->ukuran - $dt['kain_potongan_dipakai']
            ]);

            $k_id = [$dt['u1'], $dt['u2']];

            SPK::insert([
                'uuid'              => Uuid::uuid4()->getHex(),
                'kode_spp'          => $dt['kode_spp'],
                'kode_spk'          => $dt['kode_spk'],
                'kain_potongan_id'  => $kp->id,
                'artikel'           => $dt['artikel'],
                'tanggal'           => $dt['tanggal'],
                'karyawan_id'       => json_encode($k_id),
                'karyawan'          => json_encode($dt['karyawan']),
                'kain_potongan_dipakai' => $dt['kain_potongan_dipakai'],
                'jumlah_kain'       => $dt['hasil'],
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
            if(!empty($k1)){
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
            if(!empty($k2)){
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

        if(!$validate){
            return response()->json([
                'code'      => 400,
                'title'     => 'Gagal Menyimpan Gambar!',
                'message'   => 'Gambar Harus Kurang dari 2 MB atau tipe gambar harus jpeg,png,jpg,gif,svg'
            ]);
        }

        if ($request->hasfile('gambar')) {
            foreach ($request->gambar as $image) {
                $name = time().rand(1,100).'.'.$image->extension();
                if ($image->move(public_path('img/gambar/'), $name)) {
                    FileSPK::create([
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
}
