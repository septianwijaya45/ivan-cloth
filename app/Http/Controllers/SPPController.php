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
        $data = SPP::select('kode_spp', DB::raw('COUNT(*) as total'), DB::raw('DATE_FORMAT(tanggal, "%d %M %Y") as tanggal'))->groupBy('kode_spp')->get();
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
            $req_data = $request->data;
            // dd($req_data);
            foreach($req_data as $dt){
                // insert spp
                $m_kainroll = Kain_roll::where('kode_lot', $dt['nama_lot'])->first();
                $m_kainpotongan = Kain_potongan::where('kain_roll_id', $m_kainroll->id)->first();
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
    
                SPP::insert([
                    'uuid'              => Uuid::uuid4()->getHex(),
                    'kode_spp'          => $dt['kode_spp'],
                    'ukuran'            => $dt['ukuran'],
                    'kain_roll_id'      => $m_kainroll->id,
                    'tanggal'           => $dt['tanggal'],
                    'berat'             => $dt['berat'],
                    'hasil_potongan'    => $dt['hasil'],
                    'karyawan'          => json_encode($dt['karyawan']),
                    'gaji'              => $dt['gaji'],
                    'status'            => 'Belum Konfirmasi',
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ]);

                if($m_kainpotongan != null || !empty($m_kainpotongan)){
                    Kain_potongan::where('kain_roll_id', $m_kainroll->id)->update([
                        'ukuran'    => $m_kainpotongan->ukuran + $dt['hasil']
                    ]);
                }else{
                    Kain_potongan::insert([
                        'uuid'              => Uuid::uuid4()->getHex(),
                        'kain_roll_id'      => $m_kainroll->id,
                        'ukuran'            => $dt['hasil'],
                        'created_at'        => Carbon::now(),
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

    public function edit($kode_spp)
    {
        # code...
    }

    public function update(Request $request, $kode_spp)
    {
        # code...
    }

    public function destroyInsertorEdit($id)
    {
        # code...
    }

    public function destroy($kode_spp)
    {
        try {
            $spp = SPP::where('kode_spp', $kode_spp);
            $m_kainroll = Kain_roll::where('kode_spp', $spp->value('kain_roll_id'))->first();
            $m_kainpotongan = Kain_potongan::where('kain_roll_id', $spp->value('kain_roll_id'))->first();

            if($spp !== null && $m_kainroll !== null){
                $dt_spp = $spp->first();
                // update stok kain roll
                Kain_roll::where('kode_spp', $dt_spp->kain_roll_id)->update([
                    'berat'     => $m_kainpotongan->berat + $dt_spp->berat
                ]);

                //  update stok kain potongan
                Kain_potongan::where('kain_roll_id', $dt_spp->kain_roll_id)->update([
                    'ukuran'    => $m_kainpotongan->ukuran - $spp->hasil_potongan
                ]);
                $spp->delete();
            }
            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Hapus data Kain Roll',
            ]);

            $ukuran = Ukuran::all();
        
            return view('ukuran.index',$ukuran);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Hapus data Kain Roll!',
                'error'     => $th
            ]);
        }
    }
}
