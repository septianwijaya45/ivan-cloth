<?php

namespace App\Http\Controllers;

use App\Models\Ukuran;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class UkuranController extends Controller
{
    public function index()
    {
        return view('ukuran.index');
    }

    public function indexData()
    {
        $data = Ukuran::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_ukuran'    => 'required|unique:m_ukurans',
            'ukuran'          => 'required|unique:m_ukurans',
        ], [
            'kode_ukuran.required'   => 'Kode Ukuran Harus Diisi!',
            'kode_ukuran.unique'     => 'Kode Ukuran Sudah Tersedia!',
            'ukuran.required'         => 'Ukuran Harus Diisi!',
            'ukuran.unique'           => 'Ukuran Sudah Tersedia!',
        ]);

        try {
            Ukuran::create([
                'uuid'          => Uuid::uuid4()->getHex(),
                'kode_ukuran'  => $request->kode_ukuran,
                'ukuran'        => $request->ukuran,
            ]);

            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Menyimpan Data Ukuran',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Menyimpan Data Ukuran',
                'error'     => $th
            ]);
        }
    }

    public function edit($uuid)
    {
        $data = Ukuran::where('uuid', $uuid)->first();

        return response()->json($data);
    }

    public function update(Request $request, $uuid)
    {
        $this->validate($request, [
            'kode_ukuran'    => 'required|unique:m_ukurans',
            'ukuran'          => 'required|unique:m_ukurans'
        ], [
            'kode_ukuran.required'   => 'Kode Ukuran Harus Diisi!',
            'kode_ukuran.unique'     => 'Kode Ukuran Sudah Tersedia!',
            'ukuran.required'         => 'Ukuran Harus Diisi!',
            'ukuran.unique'           => 'Ukuran Sudah Tersedia!',
        ]);

        try {
            Ukuran::where('id', $request->id)
                ->where('uuid', $uuid)
                ->update([
                    'uuid'          => Uuid::uuid4()->getHex(),
                    'kode_ukuran'  => $request->kode_ukuran,
                    'ukuran'        => $request->ukuran
                ]);

            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Ubah Data Ukuran',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code'      => 500,
                'message'   => 'Gagal Ubah Data Ukuran',
                'error'     => $th
            ]);
        }
    }

    public function delete($uuid)
    {
        try {
            $data = Ukuran::where('uuid', $uuid)->first();
            Ukuran::where('id', $data->id)->delete();

            return response()->json([
                'code'      => 200,
                'message'   => 'Berhasil Hapus data Kain Roll',
            ]);

            $ukuran = Ukuran::all();

            return view('ukuran.index', $ukuran);
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
