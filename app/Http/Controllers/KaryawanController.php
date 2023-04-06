<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class KaryawanController extends Controller
{
    public function index()
    {
        return view('karyawan.index');
    }
    public function indexData()
    {
        $data = Karyawan::all();
        return response()->json($data);
    }

    public function addData(Request $request)
    {
        $this->validate($request, [
            'nama'            => 'required',
            'jenis_kelamin'   => 'required',
            'nik'             => 'required|numeric|digits:16',
            'no_telepon'      => 'required|numeric',
            'npwp'            => 'required|numeric|digits:16',
            'posisi'          => 'required',
            'gaji_pokok'      => 'required|numeric|min:0'
        ]);

        Karyawan::create([
            'uuid'            => Uuid::uuid4()->getHex(),
            'nama'            => $request->nama,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'nik'             => $request->nik,
            'no_telepon'      => $request->no_telepon,
            'npwp'            => $request->npwp,
            'posisi'          => $request->posisi,
            'status_karyawan' => 'Aktif',
            'gaji_pokok'      => $request->gaji_pokok,
        ]);

        return response()->json([
            'code'      => 200,
            'message'   => 'Berhasil menyimpan data Karyawan',
        ]);
    }

    public function detailData($uuid)
    {
        $data = Karyawan::where('uuid', $uuid)->first();
        return response()->json($data);
    }

    public function updateData(Request $request, $uuid)
    {
        $this->validate($request, [
            'nama'            => 'required',
            'jenis_kelamin'   => 'required',
            'nik'             => 'required|numeric|digits:16',
            'no_telepon'      => 'required',
            'npwp'            => 'required|numeric|digits:16',
            'posisi'          => 'required',
            'status_karyawan' => 'required',
            'gaji_pokok'      => 'required|numeric|min:0'
        ]);

        Karyawan::where('id', $request->id)
            ->where('uuid', $uuid)
            ->update([
                'nama'            => $request->nama,
                'jenis_kelamin'   => $request->jenis_kelamin,
                'nik'             => $request->nik,
                'no_telepon'      => $request->no_telepon,
                'npwp'            => $request->npwp,
                'posisi'          => $request->posisi,
                'status_karyawan' => $request->status_karyawan,
                'gaji_pokok'      => $request->gaji_pokok,
            ]);

        return response()->json([
            'code'      => 200,
            'message'   => 'Berhasil ubah data Karyawan',
        ]);
    }

    public function deleteData($uuid)
    {
        $data = Karyawan::where('uuid', $uuid)->first();
        if ($data) {
            Karyawan::where('id', $data->id)->delete();

            return response()->json([
                'code' => 200,
                'message' => 'Berhasil Hapus data Karyawan',
            ]);
        }
    }
}
