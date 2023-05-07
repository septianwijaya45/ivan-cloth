<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class PengeluaranController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->format('Y-m-d');
        return view('pengeluaran.index', compact(['date']));
    }

    public function indexData(Request $request)
    {
        if($request->method() == 'GET'){
            $data = Pengeluaran::select(DB::raw('COUNT(*) as total'), 'kode_pengeluaran', DB::raw("DATE_FORMAT(tanggal, '%d %M %Y') as tanggal"), 'uuid', 'status')
                    ->orderBy('id', 'DESC')
                    ->groupBy('kode_pengeluaran')
                    ->get();
        }

        if($request->method() == 'POST'){
            $data = Pengeluaran::select(DB::raw('COUNT(*) as total'), 'kode_pengeluaran', DB::raw("DATE_FORMAT(tanggal, '%d %M %Y') as tanggal"), 'uuid', 'status')
            ->where('tanggal', '>=', "$request->fromDate")
            ->where('tanggal', '<=', "$request->toDate")
            ->orderBy('id', 'DESC')
            ->groupBy('kode_pengeluaran')
            ->get();
        }
        
        return \DataTables::of($data)
                    ->addColumn('Action', function($data){
                        return '<a href="pengeluaran/edit-data/'.$data->uuid.'"> <button class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></button></a>
                        <button type="button" class="btn btn-danger btn-sm" onClick="deleteData('.$data->id.')"><i class="fa fa-trash"></i></button>';
                    })
                    ->addColumn('Status', function($data){
                        if($data->status == 'Belum Konfirmasi'){
                            return '<button class="btn btn-danger btn-sm" title="Confirm Data!" onClick="confirmPengeluaran()"> Belum Konfirmasi </button>';
                        }
                        if($data->status == 'Selesai Dikerjakan'){
                            return '<span class="bg-success p-2">Selesai Dikerjakan</span>';
                        }
                    })
                    ->rawColumns(['Action', 'Status'])
                    ->addIndexColumn()
                    ->make(true);
    }

    public function insert()
    {
        $date = Carbon::now()->format('Y-m-d');
        return view('pengeluaran.insert', compact(['date']));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->data;
            foreach($data as $dt){
                Pengeluaran::insert([
                    'uuid'                  => Uuid::uuid4()->getHex(),
                    'kode_pengeluaran'      => $dt['kode_pengeluaran'],
                    'jenis_pengeluaran'     => $dt['jenis_pengeluaran'],
                    'keperluan'             => $dt['keperluan'],
                    'total_uang'            => $dt['total_uang'],
                    'keterangan'            => $dt['keterangan'],
                    'tanggal'                => $dt['tanggal'],
                    'status'                => 'Belum Konfirmasi',
                    'created_at'            => Carbon::now(),
                    'updated_at'            => Carbon::now()
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

    public function edit($uuid)
    {
        $pengeluaran = Pengeluaran::where('uuid', $uuid)->first();
        $pengeluarans = Pengeluaran::where('kode_pengeluaran', $pengeluaran->kode_pengeluaran)->get();
        $date = Carbon::now()->format('Y-m-d');

        return view('pengeluaran.update', compact(['pengeluaran', 'pengeluarans', 'date']));
    }

    public function update(Request $request)
    {
        try{
            $data = $request->data;
            foreach($data as $dt){
                $checkPengeluaran = Pengeluaran::where([
                    ['uuid', $dt['uuid']],
                    ['kode_pengeluaran', $dt['kode_pengeluaran']]
                ])->first();

                if(!empty($checkPengeluaran)){
                    Pengeluaran::where('uuid', $dt['uuid'])
                        ->where('kode_pengeluaran', $dt['kode_pengeluaran'])
                        ->update([
                            'kode_pengeluaran'      => $dt['kode_pengeluaran'],
                            'jenis_pengeluaran'     => $dt['jenis_pengeluaran'],
                            'keperluan'             => $dt['keperluan'],
                            'total_uang'        => $dt['total_uang'],
                            'keterangan'        => $dt['keterangan'],
                            'tanggal'           => $dt['tanggal'],
                        ]);
                }else{
                    Pengeluaran::insert([
                        'uuid'              => Uuid::uuid4()->getHex(),
                        'kode_pengeluaran'      => $dt['kode_pengeluaran'],
                        'jenis_pengeluaran'     => $dt['jenis_pengeluaran'],
                        'keperluan'             => $dt['keperluan'],
                        'total_uang'        => $dt['total_uang'],
                        'keterangan'        => $dt['keterangan'],
                        'tanggal'           => $dt['tanggal'],
                        'status'            => 'Belum Konfirmasi',
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

    public function destroy($uuid)
    {
        try {
            $pengeluaran = Pengeluaran::where('uuid', $uuid);

            if($pengeluaran !== null){
                $dt_pengeluaran = $pengeluaran->first();

                Pengeluaran::where('kode_pengeluaran', $dt_pengeluaran->kode_pengeluaran)->delete();

                return response()->json([
                    'code'      => 200,
                    'message'   => 'Berhasil Hapus data detail pengeluaran',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Hapus data pengeluaran!',
                'error'     => $th
            ]);
        }
    }

    public function destroyDetail($uuid)
    {
        try {
            $pengeluaran = Pengeluaran::where('uuid', $uuid);

            if($pengeluaran !== null){
                $pengeluaran->delete();

                return response()->json([
                    'code'      => 200,
                    'message'   => 'Berhasil Hapus data detail pengeluaran',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Hapus data pengeluaran!',
                'error'     => $th
            ]);
        }
    }
}
