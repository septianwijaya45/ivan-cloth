<?php

namespace App\Http\Controllers;

use App\Models\GajiMaster;
use App\Models\JahitModel;
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
        return view('jahit.index');
    }

    public function indexData(Request $request)
    {
        $data = JahitModel::select('uuid', 'kode_jahit', DB::raw('COUNT(*) as total'), DB::raw('DATE_FORMAT(tanggal, "%d %M %Y") as tanggal'), 'status')->groupBy('kode_jahit')->get();
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
}
