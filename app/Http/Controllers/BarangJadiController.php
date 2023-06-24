<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BarangJadi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangJadiController extends Controller
{
    public function index()
    {
        return view('barang_jadi.index');
    }

    public function indexData($status)
    {
        $data = BarangJadi::join('t_finishings', 't_finishings.id', '=', 'm_barang_jadies.finishing_id')
            ->join('t_jahits', 't_jahits.id', '=', 't_finishings.jahit_id')
            ->join('t_spk_details', 't_spk_details.id', '=', 't_jahits.detail_spk_id')
            ->join('m_kain_potongans', 'm_kain_potongans.id', '=', 't_spk_details.kain_potongan_id')
            ->join('m_kain_rolls', 'm_kain_rolls.id', '=', 'm_kain_potongans.kain_roll_id')
            ->select(
                'm_barang_jadies.*',
                't_finishings.kode_finishing',
                DB::raw('CONCAT(m_barang_jadies.total_barang," ",t_finishings.satuan) as jml_barang'),
                DB::raw('DATE_FORMAT(m_barang_jadies.tanggal, "%d %M %Y") as tanggal'),
                'm_kain_potongans.ukuran',
                'm_kain_rolls.kode_lot',
                'm_kain_rolls.jenis_kain',
                'm_kain_rolls.warna'
            )
            ->where('m_barang_jadies.status', $status)
            ->get();
        return response()->json($data);
    }

    public function confirm($id)
    {
        try {
            BarangJadi::where('id', $id)->update([
                'status' => 'Sudah Diambil'
            ]);

            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Konfirmasi Data Barang Jadi!',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Konfirmasi Data Barang Jadi!',
                'error'     => $th
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            BarangJadi::where('id', $id)->delete();

            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Hapus data Barang Jadi!',
            ]);

            // $ukuran = Ukuran::all();

            // return view('ukuran.index', $ukuran);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Hapus data Barang Jadi!',
                'error'     => $th
            ]);
        }
    }
}
