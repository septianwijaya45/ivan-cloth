<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiGajiController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->format('Y-m-d');
        return view('transaksigaji.index', compact(['date']));
    }

    public function indexData(Request $request)
    {
        if($request->method() == 'GET'){
            $data = Gaji::select('t_gajies.kode_transaksi', DB::raw('SUM(t_gajies.gaji) as total'), 'm_karyawans.nama', 'm_karyawans.posisi', 't_gajies.status', 't_gajies.karyawan_id')
                    ->join('m_karyawans', 'm_karyawans.id', '=', 't_gajies.karyawan_id')
                    ->where('t_gajies.status', '=', 'Belum Dibayar')
                    ->orWhere('t_gajies.status', '=', '')
                    ->orderBy('t_gajies.id', 'DESC')
                    ->groupBy('kode_transaksi', 'karyawan_id')
                    ->get();
        }

        if($request->method() == 'POST'){
            $from   = date('Y-m-d', strtotime($request->fromDate));
            $from   = $from.' 00:00:00';
            $to     = date('Y-m-d', strtotime($request->toDate));
            $to     = $to.' 23:59:59';
            $status = $request->status;
            $data = Gaji::select('t_gajies.kode_transaksi', DB::raw('SUM(t_gajies.gaji) as total'), 'm_karyawans.nama', 'm_karyawans.posisi', 't_gajies.status', 't_gajies.karyawan_id')
                    ->join('m_karyawans', 'm_karyawans.id', '=', 't_gajies.karyawan_id')
                    ->where('t_gajies.created_at', '>=', "$from")
                    ->where('t_gajies.created_at', '<=', "$to")
                    ->where('t_gajies.status', '=', "$status")
                    ->orderBy('t_gajies.id', 'DESC')
                    ->groupBy('kode_transaksi', 'karyawan_id')
                    ->get();
        }

        return \DataTables::of($data)
                    ->addColumn('Status', function($data){
                        if($data->status == 'Belum Dibayar' || $data->status == ''){
                            return '<button class="btn btn-danger btn-sm" title="Confirm Data!" onClick="confirmGaji(`'.$data->kode_transaksi.'`, '.$data->karyawan_id.')"> Belum Dibayar </button>';
                        }
                        if($data->status == 'Sudah Dibayar'){
                            return '<span class="bg-success p-2">Sudah Dibayar</span>';
                        }
                    })
                    ->rawColumns(['Action', 'Status'])
                    ->addIndexColumn()
                    ->make(true);
    }

    public function confirmGaji($sp, $id)
    {
        try {
            $gaji = Gaji::where('kode_transaksi', $sp)
                        ->where('karyawan_id', $id);

            if($gaji !== null){
                $gaji->update([
                    'status'    => 'Sudah Dibayar'
                ]);

                return response()->json([
                    'code'      => 200,
                    'message'   => 'Berhasil Konfirmasi Pembayaran Gaji!',
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Konfirmasi Pembayaran Gaji!',
                'error'     => $th
            ]);
        }
    }
}
