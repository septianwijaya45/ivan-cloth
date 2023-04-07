<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Perlengkapan;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class PerlengkapanController extends Controller
{
    public function index()
    {
        return view('perlengkapan.index');
    }

    public function indexData()
    {
        $data = Perlengkapan::all();
        return response()->json($data);
    }

    public function addData(Request $request)
    {
        $this->validate($request, [
            'nama'          => 'required',
            'total_stok'    => 'required|numeric',
        ]);

        Perlengkapan::create([
            'uuid'          => Uuid::uuid4()->getHex(),
            'nama'          => $request->nama,
            'total_stok'    => $request->total_stok,
        ]);

        return response()->json([
            'code'      => 200,
            'message'   => 'Berhasil menyimpan data Perlengkapan',
        ]);
    }

    public function detailData($uuid)
    {
        $data = Perlengkapan::where('uuid', $uuid)->first();
        return response()->json($data);
    }

    public function updateData(Request $request, $uuid)
    {
        $this->validate($request, [
            'nama'          => 'required',
            'total_stok'    => 'required|numeric',
        ]);

        Perlengkapan::where('id', $request->id)
            ->where('uuid', $uuid)
            ->update([
                'nama'          => $request->nama,
                'total_stok'    => $request->total_stok,
            ]);

        return response()->json([
            'code'      => 200,
            'message'   => 'Berhasil ubah data Perlengkapan',
        ]);
    }

    public function deleteData($uuid)
    {
        $data = Perlengkapan::where('uuid', $uuid)->first();
        if ($data) {
            Perlengkapan::where('id', $data->id)->delete();

            return response()->json([
                'code' => 200,
                'message' => 'Berhasil Hapus data Perlengkapan',
            ]);
        }
    }
}
