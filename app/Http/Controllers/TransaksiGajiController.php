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
            $data = Gaji::select('t_gajies.kode_transaksi', DB::raw('SUM(t_gajies.gaji) as total'), 'm_karyawans.nama', 'm_karyawans.posisi')
                    ->join('m_karyawans', 'm_karyawans.id', '=', 't_gajies.karyawan_id')
                    ->orderBy('t_gajies.id', 'DESC')
                    ->groupBy('kode_transaksi', 'karyawan_id')
                    ->get();
        }

        if($request->method() == 'POST'){
            $from   = date('Y-m-d', strtotime($request->fromDate));
            $from   = $from.' 00:00:00';
            $to     = date('Y-m-d', strtotime($request->toDate));
            $to     = $to.' 23:59:59';
            $data = Gaji::select('t_gajies.kode_transaksi', DB::raw('SUM(t_gajies.gaji) as total'), 'm_karyawans.nama', 'm_karyawans.posisi')
                    ->join('m_karyawans', 'm_karyawans.id', '=', 't_gajies.karyawan_id')
                    ->where('t_gajies.created_at', '>=', "$from")
                    ->where('t_gajies.created_at', '<=', "$to")
                    ->orderBy('t_gajies.id', 'DESC')
                    ->groupBy('kode_transaksi', 'karyawan_id')
                    ->get();
        }

        return \DataTables::of($data)
                    ->addColumn('Action', function($data){
                        return '<a href="pemasukkan/edit-data/'.$data->uuid.'"> <button class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></button></a>
                        <button type="button" class="btn btn-danger btn-sm" onClick="deleteData('.$data->id.')"><i class="fa fa-trash"></i></button>';
                    })
                    ->addColumn('Status', function($data){
                        if($data->status == 'Belum Konfirmasi'){
                            return '<button class="btn btn-danger btn-sm" title="Confirm Data!" onClick="confirmPemasukkan()"> Belum Konfirmasi </button>';
                        }
                        if($data->status == 'Selesai Dikerjakan'){
                            return '<span class="bg-success p-2">Selesai Dikerjakan</span>';
                        }
                    })
                    ->rawColumns(['Action', 'Status'])
                    ->addIndexColumn()
                    ->make(true);
    }
}
