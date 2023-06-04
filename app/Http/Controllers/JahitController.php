<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\GajiMaster;
use App\Models\Jahit;
use App\Models\Karyawan;
use App\Models\SPK;
use App\Models\SPKDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JahitController extends Controller
{
    public function index()
    {
        $karyawan   = Karyawan::where('posisi', 'jahit')->get();
        $gaji       = GajiMaster::all();
        return view('jahit.index', compact(['karyawan', 'gaji']));
    }

    public function indexData(Request $request)
    {
        $data = Jahit::join('t_spk_details', 't_spk_details.id', '=', 't_jahits.detail_spk_id')
            ->join('m_kain_potongans', 'm_kain_potongans.id', '=', 't_spk_details.kain_potongan_id')
            ->join('m_kain_rolls', 'm_kain_rolls.id', '=', 'm_kain_potongans.kain_roll_id')
            ->select(
                't_jahits.*',
                DB::raw('CONCAT(t_jahits.jumlah_jahit," ",t_jahits.satuan) as jml_jahit'),
                DB::raw('DATE_FORMAT(t_jahits.tanggal, "%d %M %Y") as tanggal'),
                'm_kain_potongans.ukuran',
                'm_kain_rolls.kode_lot',
                'm_kain_rolls.jenis_kain',
                'm_kain_rolls.warna'
            )->get();
        return response()->json($data);
    }

    public function getArtikelFromSPK($kode_spk)
    {
        $data = SPK::select('t_spks.id', 'm_kain_potongans.id as id_potongan', 't_spks.artikel', DB::raw('CONCAT(t_spks.artikel, " | ", m_kain_rolls.kode_lot, " | ", m_kain_rolls.jenis_kain, " | ", m_kain_rolls.warna) as nama'))
            ->join('t_spk_details', 't_spk_details.kode_spk', '=', 't_spks.kode_spk')
            ->join('m_kain_potongans', 'm_kain_potongans.id', '=', 't_spk_details.kain_potongan_id')
            ->join('m_kain_rolls', 'm_kain_rolls.id', '=', 'm_kain_potongans.kain_roll_id')
            ->where('t_spks.kode_spk', $kode_spk)
            ->get();

        return response()->json($data);
    }

    public function getQuantityArtikel($id)
    {
        $explodeData = explode(',', $id);
        $id = $explodeData[0];
        $kainPotonganId = $explodeData[1];
        $data = SPKDetail::select(DB::raw('SUM(quantity) as quantity'))
            ->where('t_spk_id', $id)
            ->where('kain_potongan_id', $kainPotonganId)
            ->first();
        return response()->json($data);
    }

    public function insert()
    {
        $karyawan   = Karyawan::where('posisi', 'jahit')->get();
        $gaji       = GajiMaster::all();
        $spk        = SPK::all();

        $date = Carbon::now()->format('Y-m-d');
        return view('jahit.insert', compact(['spk', 'karyawan', 'gaji', 'date']));
    }

    public function detailFormKaryawan($kode_jahit)
    {
        $data = Jahit::where('kode_jahit', $kode_jahit)->first();
        return response()->json($data);
    }

    public function addKaryawanJahit(Request $request, $id)
    {
        // try {
        $k_id = [$request->karyawan1, $request->karyawan2];

        $k1 = Karyawan::where('uuid', $request->karyawan1)->first();
        $k2 = Karyawan::where('uuid', $request->karyawan2)->first();

        $karyawan = [$k1->nama, $k2->nama];

        Jahit::where('id', $id)->update([
            'karyawan_id' => json_encode($k_id),
            'karyawan'    => json_encode($karyawan),
            'gaji'        => $request->gaji,
            'note'        => $request->note,
            'status'      => 'Belum Konfirmasi',
        ]);

        // gaji
        if (!empty($k1)) {
            Gaji::insert([
                [
                    'karyawan_id'       => $k1->id,
                    'kode_transaksi'    => $request->kode_jahit,
                    'gaji'              => $request->gaji * $request->jumlah_jahit,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now()
                ]
            ]);
        }
        if (!empty($k2)) {
            Gaji::insert([
                [
                    'karyawan_id'       => $k2->id,
                    'kode_transaksi'    => $request->kode_jahit,
                    'gaji'              => $request->gaji * $request->jumlah_jahit,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now()
                ]
            ]);
        }

        return response()->json([
            'code'      => 200,
            'message'   => 'Berhasil Menambahkan Karyawan!'
        ]);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'code'      => 500,
        //         'message'   => 'Gagal Menambahkan Karyawan',
        //         'error'     => $th
        //     ]);
        // }
    }
}
