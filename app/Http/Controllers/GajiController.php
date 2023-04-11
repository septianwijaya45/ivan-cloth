<?php

namespace App\Http\Controllers;

use App\Models\GajiMaster;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class GajiController extends Controller
{
    public function index()
    {
        return view('gaji.index');
    }

    public function indexData()
    {
        $data = GajiMaster::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'gaji'    => 'required|unique:m_gajis'
        ], [
            'gaji.required'   => 'Gaji Harus Diisi!',
            'gaji.unique'     => 'Gaji Sudah Tersedia!',
        ]);

        try {
            GajiMaster::create([
                'uuid'          => Uuid::uuid4()->getHex(),
                'gaji'          => $request->gaji
            ]);
    
            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Menyimpan Data Gaji',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Menyimpan Data Gaji',
                'error'     => $th
            ]);
        }
    }

    public function edit($uuid)
    {
        $data = GajiMaster::where('uuid', $uuid)->first();

        return response()->json($data);
    }

    public function update(Request $request, $uuid)
    {
        $this->validate($request, [
            'gaji'    => 'required|unique:m_gajis'
        ], [
            'gaji.required'   => 'Gaji Harus Diisi!',
            'gaji.unique'     => 'Gaji Sudah Tersedia!',
        ]);

        try {
            GajiMaster::where('id', $request->id)
                ->where('uuid', $uuid)
                ->update([
                    'uuid'          => Uuid::uuid4()->getHex(),
                    'gaji'    => $request->gaji
                ]);
    
            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Ubah Data Gaji',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Ubah Data Gaji',
                'error'     => $th
            ]);
        }
    }

    public function delete($uuid)
    {
        try {
            $data = GajiMaster::where('uuid', $uuid)->first();
            GajiMaster::where('id', $data->id)->delete();

            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Hapus data Kain Roll',
            ]);

            $gaji = GajiMaster::all();
        
            return view('gaji.index',$gaji);
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
