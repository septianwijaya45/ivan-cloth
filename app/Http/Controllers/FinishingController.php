<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BarangJadi;
use App\Models\FinishingModel;
use App\Models\Gaji;
use App\Models\GajiMaster;
use App\Models\Karyawan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class FinishingController extends Controller
{
    public function index()
    {
        $karyawan   = Karyawan::where('posisi', 'finishing')->where('posisi', 'Finishing')->get();
        $gaji       = GajiMaster::all();
        return view('finishing.index', compact(['karyawan', 'gaji']));
    }

    public function indexData($status)
    {
        $data = FinishingModel::join('t_jahits', 't_jahits.id', '=', 't_finishings.jahit_id')
            ->join('t_spk_details', 't_spk_details.id', '=', 't_jahits.detail_spk_id')
            ->join('m_kain_potongans', 'm_kain_potongans.id', '=', 't_spk_details.kain_potongan_id')
            ->join('m_kain_rolls', 'm_kain_rolls.id', '=', 'm_kain_potongans.kain_roll_id')
            ->select(
                't_finishings.*',
                't_jahits.kode_jahit',
                DB::raw('CONCAT(t_finishings.jumlah_finishing," ",t_finishings.satuan) as jml_finishing'),
                DB::raw('DATE_FORMAT(t_finishings.tanggal, "%d %M %Y") as tanggal'),
                'm_kain_potongans.ukuran',
                'm_kain_rolls.kode_lot',
                'm_kain_rolls.jenis_kain',
                'm_kain_rolls.warna'
            )
            ->where('t_finishings.status', $status)
            ->get();
        return response()->json($data);
    }

    public function detailFormKaryawan($kode_finishing)
    {
        $data = FinishingModel::where('kode_finishing', $kode_finishing)->first();
        if ($data->karyawan != null) {
            $karyawan = json_decode($data->karyawan_id);
            $data['karyawan1'] = $karyawan[0];
            $data['karyawan2'] = $karyawan[1];
        }
        return response()->json($data);
    }

    public function addKaryawanFinishing(Request $request, $id)
    {
        // try {
        $k_id = [$request->karyawan1, $request->karyawan2];

        $k1 = Karyawan::where('uuid', $request->karyawan1)->first();
        $k2 = Karyawan::where('uuid', $request->karyawan2)->first();

        if(!is_null($k1) && !is_null($k2)){
            $karyawan = [$k1->nama, $k2->nama];
        }

        if(is_null($k2)){
            $karyawan = [$k1->nama];
        }

        FinishingModel::where('id', $id)->update([
            'karyawan_id' => json_encode($k_id),
            'karyawan'    => json_encode($karyawan),
            'gaji'        => $request->gaji_add,
            'note'        => $request->note,
            'status'      => 'Belum Konfirmasi',
        ]);

        // gaji
        if (!empty($k1)) {
            Gaji::insert([
                [
                    'karyawan_id'       => $k1->id,
                    'kode_transaksi'    => $request->kode_finishing,
                    'gaji'              => $request->gaji_add * $request->jumlah_finishing,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now()
                ]
            ]);
        }
        if (!empty($k2)) {
            Gaji::insert([
                [
                    'karyawan_id'       => $k2->id,
                    'kode_transaksi'    => $request->kode_finishing,
                    'gaji'              => $request->gaji_add * $request->jumlah_finishing,
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

    public function updateKaryawanFinishing(Request $request, $id)
    {
        // try {
        $k_id = [$request->karyawan1, $request->karyawan2];

        $k1 = Karyawan::where('uuid', $request->karyawan1)->first();
        $k2 = Karyawan::where('uuid', $request->karyawan2)->first();

        $karyawan = [$k1->nama, $k2->nama];

        FinishingModel::where('id', $id)->update([
            'karyawan_id' => json_encode($k_id),
            'karyawan'    => json_encode($karyawan),
            'gaji'        => $request->gaji,
            'note'        => $request->note,
            'status'      => 'Belum Konfirmasi',
        ]);

        // gaji
        Gaji::where('kode_transaksi', $request->kode_finishing)->delete();

        if (!empty($k1)) {
            Gaji::insert([
                [
                    'karyawan_id'       => $k1->id,
                    'kode_transaksi'    => $request->kode_finishing,
                    'gaji'              => $request->gaji * $request->jumlah_finishing,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now()
                ]
            ]);
        }
        if (!empty($k2)) {
            Gaji::insert([
                [
                    'karyawan_id'       => $k2->id,
                    'kode_transaksi'    => $request->kode_finishing,
                    'gaji'              => $request->gaji * $request->jumlah_finishing,
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

    public function confirm($kode_finishing)
    {
        try {
            FinishingModel::where('kode_finishing', $kode_finishing)->update([
                'status' => 'Sedang Dikerjakan'
            ]);

            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Konfirmasi Data Finishing!',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Konfirmasi Data Finishing!',
                'error'     => $th
            ]);
        }
    }

    public function finished($kode_finishing)
    {
        try {
            FinishingModel::where('kode_finishing', $kode_finishing)->update([
                'status' => 'Selesai Dikerjakan'
            ]);

            $finishing = FinishingModel::where('kode_finishing', $kode_finishing)->first();

            BarangJadi::create([
                'uuid'              => Uuid::uuid4()->getHex(),
                'finishing_id'      => $finishing->id,
                'artikel'           => $finishing->artikel,
                'tanggal'           => Carbon::now(),
                'total_barang'      => $finishing->jumlah_finishing,
                'status'            => 'Belum Diambil',
            ]);

            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Konfirmasi Data Finishing!
                <br> Hasil Finishing telah berhasil ditambahkan ke Barang Jadi!',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Konfirmasi Data Finishing!',
                'error'     => $th
            ]);
        }
    }

    public function destroy($kode_finishing)
    {
        try {
            $finishing = FinishingModel::where('kode_finishing', $kode_finishing)->first();
            if ($finishing->karyawan_id !== null) {
                Gaji::where('kode_transaksi', $finishing->kode_finishing)->delete();
            }

            FinishingModel::where('id', $finishing->id)->delete();

            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Hapus data Surat Finishing!',
            ]);

            // $ukuran = Ukuran::all();

            // return view('ukuran.index', $ukuran);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Hapus data Surat Finishing!',
                'error'     => $th
            ]);
        }
    }
}
