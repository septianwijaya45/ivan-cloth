<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kain_roll;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class KainRollController extends Controller
{
    public function index()
    {
        return view('kain_roll.index');
    }

    public function indexData()
    {
        $data = Kain_roll::all();
        return response()->json($data);
    }

    public function addData(Request $request)
    {
        $this->validate($request, [
            'kode_lot'      => 'required|unique:m_kain_rolls,kode_lot',
            'jenis_kain'    => 'required',
            'warna'         => 'required',
            'stok_roll'     => 'required|numeric',
            'berat'         => 'required|numeric|min:0.1',
        ]);

        Kain_roll::create([
            'uuid'          => Uuid::uuid4()->getHex(),
            'kode_lot'      => $request->kode_lot,
            'jenis_kain'    => $request->jenis_kain,
            'warna'         => $request->warna,
            'stok_roll'     => $request->stok_roll,
            'berat'         => $request->berat,
        ]);

        return response()->json([
            'code'      => 200,
            'message'   => 'Berhasil menyimpan data Kain Roll',
        ]);
    }

    public function detailData($uuid)
    {
        $data = Kain_roll::where('uuid', $uuid)->first();
        return response()->json($data);
    }

    public function updateData(Request $request, $uuid)
    {
        $this->validate($request, [
            'kode_lot'      => 'required',
            'jenis_kain'    => 'required',
            'warna'         => 'required',
            'stok_roll'     => 'required|numeric',
            'berat'         => 'required|numeric|min:0.1',
        ]);

        Kain_roll::where('id', $request->id)
            ->where('uuid', $uuid)
            ->update([
                'kode_lot'      => $request->kode_lot,
                'jenis_kain'    => $request->jenis_kain,
                'warna'         => $request->warna,
                'stok_roll'     => $request->stok_roll,
                'berat'         => $request->berat,
            ]);

        return response()->json([
            'code'      => 200,
            'message'   => 'Berhasil ubah data Kain Roll',
        ]);
    }

    public function deleteData($uuid)
    {
        $data = Kain_roll::where('uuid', $uuid)->first();
        if ($data) {
            Kain_roll::where('id', $data->id)->delete();

            return response()->json([
                'code' => 200,
                'message' => 'Berhasil Hapus data Kain Roll',
            ]);
        }
        $kain_roll = Kain_roll::all();

        return view('kain_roll.index', $kain_roll);
    }
}
