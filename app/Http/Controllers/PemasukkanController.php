<?php

namespace App\Http\Controllers;

use App\Models\Pemasukkan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class PemasukkanController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->format('Y-m-d');
        return view('pemasukkan.index', compact(['date']));
    }

    public function indexData(Request $request)
    {
        if($request->method() == 'GET'){
            $data = Pemasukkan::select(DB::raw('COUNT(*) as total'), 'kode_pemasukan', DB::raw("DATE_FORMAT(tanggal, '%d %M %Y') as tanggal"), 'uuid', 'status')
                    ->orderBy('id', 'DESC')
                    ->groupBy('kode_pemasukan')
                    ->get();
        }

        if($request->method() == 'POST'){
            $data = Pemasukkan::select(DB::raw('COUNT(*) as total'), 'kode_pemasukan', DB::raw("DATE_FORMAT(tanggal, '%d %M %Y') as tanggal"), 'uuid', 'status')
            ->where('tanggal', '>=', "$request->fromDate")
            ->where('tanggal', '<=', "$request->toDate")
            ->orderBy('id', 'DESC')
            ->groupBy('kode_pemasukan')
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

    public function insert()
    {
        $date = Carbon::now()->format('Y-m-d');
        return view('pemasukkan.insert', compact(['date']));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->data;
            foreach($data as $dt){
                Pemasukkan::insert([
                    'uuid'              => Uuid::uuid4()->getHex(),
                    'kode_pemasukan'    => $dt['kode_pemasukan'],
                    'jenis_penjualan'   => $dt['jenis_penjualan'],
                    'pemasukkan'        => $dt['pemasukkan'],
                    'total_uang'        => $dt['total_uang'],
                    'keterangan'        => $dt['keterangan'],
                    'tanggal'           => $dt['tanggal'],
                    'status'            => 'Belum Konfirmasi',
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now()
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
        $pemasukkan = Pemasukkan::where('uuid', $uuid)->first();
        $pemasukkans = Pemasukkan::where('kode_pemasukan', $pemasukkan->kode_pemasukan)->get();
        $date = Carbon::now()->format('Y-m-d');

        return view('pemasukkan.update', compact(['pemasukkan', 'pemasukkans', 'date']));
    }

    public function update(Request $request)
    {
        try{
            $data = $request->data;
            foreach($data as $dt){
                $checkPemasukkan = Pemasukkan::where([
                    ['uuid', $dt['uuid']],
                    ['kode_pemasukan', $dt['kode_pemasukan']]
                ])->first();

                if(!empty($checkPemasukkan)){
                    Pemasukkan::where('uuid', $dt['uuid'])
                        ->where('kode_pemasukan', $dt['kode_pemasukan'])
                        ->update([
                            'kode_pemasukan'    => $dt['kode_pemasukan'],
                            'jenis_penjualan'   => $dt['jenis_penjualan'],
                            'pemasukkan'        => $dt['pemasukkan'],
                            'total_uang'        => $dt['total_uang'],
                            'keterangan'        => $dt['keterangan'],
                            'tanggal'           => $dt['tanggal'],
                        ]);
                }else{
                    Pemasukkan::insert([
                        'uuid'              => Uuid::uuid4()->getHex(),
                        'kode_pemasukan'    => $dt['kode_pemasukan'],
                        'jenis_penjualan'   => $dt['jenis_penjualan'],
                        'pemasukkan'        => $dt['pemasukkan'],
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
            $pemasukkan = Pemasukkan::where('uuid', $uuid);

            if($pemasukkan !== null){
                $dt_pemasukkan = $pemasukkan->first();

                Pemasukkan::where('kode_pemasukan', $dt_pemasukkan->kode_pemasukan)->delete();

                return response()->json([
                    'code'      => 200,
                    'message'   => 'Berhasil Hapus data detail pemasukkan',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Hapus data pemasukkan!',
                'error'     => $th
            ]);
        }
    }

    public function destroyDetail($uuid)
    {
        try {
            $pemasukkan = Pemasukkan::where('uuid', $uuid);

            if($pemasukkan !== null){
                $pemasukkan->delete();

                return response()->json([
                    'code'      => 200,
                    'message'   => 'Berhasil Hapus data detail pemasukkan',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Hapus data pemasukkan!',
                'error'     => $th
            ]);
        }
    }
}
