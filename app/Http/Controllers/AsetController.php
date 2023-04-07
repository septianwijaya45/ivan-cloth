<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class AsetController extends Controller
{
    public function index()
    {
        return view('aset.index');
    }

    public function indexData()
    {
        $data = Aset::all();
        return response()->json($data);
    }

    public function addData(Request $request)
    {
        $this->validate($request, [
            'nama'          => 'required',
            'kode'          => 'required',
            'status'        => 'required',
            'total_stok'    => 'required|numeric',
        ]);

        Aset::create([
            'uuid'          => Uuid::uuid4()->getHex(),
            'nama'          => $request->nama,
            'kode'          => $request->kode,
            'status'        => $request->status,
            'total_stok'    => $request->total_stok,
        ]);

        return response()->json([
            'code'      => 200,
            'message'   => 'Berhasil menyimpan data Aset',
        ]);
    }

    public function detailData($uuid)
    {
        $data = Aset::where('uuid', $uuid)->first();
        return response()->json($data);
    }

    public function updateData(Request $request, $uuid)
    {
        $this->validate($request, [
            'nama'          => 'required',
            'kode'          => 'required',
            'status'        => 'required',
            'total_stok'    => 'required|numeric',
        ]);

        Aset::where('id', $request->id)
            ->where('uuid', $uuid)
            ->update([
                'nama'          => $request->nama,
                'kode'          => $request->kode,
                'status'        => $request->status,
                'total_stok'    => $request->total_stok,
            ]);

        return response()->json([
            'code'      => 200,
            'message'   => 'Berhasil ubah data Aset',
        ]);
    }

    public function deleteData($uuid)
    {
        $data = Aset::where('uuid', $uuid)->first();
        if ($data) {
            Aset::where('id', $data->id)->delete();

            return response()->json([
                'code' => 200,
                'message' => 'Berhasil Hapus data Aset',
            ]);
        }
    }
}
