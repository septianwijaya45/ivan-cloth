<?php

namespace App\Http\Controllers;

use App\Models\Kain_potongan;
use App\Models\Kain_roll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class KainPotonganController extends Controller
{
    public function index()
    {
        $kain_roll = Kain_roll::select('id','kode_lot','jenis_kain')->get();
        return view('kain_potongan.index', compact(['kain_roll']));
    }

    public function indexData()
    {
        $data = DB::select("
            SELECT CONCAT(kr.kode_lot, ' | ', kr.jenis_kain) as kain_roll, kp.ukuran, kp.uuid, kp.id
            FROM m_kain_rolls kr, m_kain_potongans kp
            WHERE kr.id = kp.kain_roll_id
        ");
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kain_roll_id'  => 'required',
            'ukuran'        => 'required|numeric|min:0'
        ]);

        Kain_potongan::create([
            'uuid'          => Uuid::uuid4()->getHex(),
            'kain_roll_id'  => $request->kain_roll_id,
            'ukuran'        => $request->ukuran
        ]);

        return response()->json([
            'code'      => 200,
            'message'   => 'Berhasil menyimpan data Kain Roll',
        ]);
    }

    public function detail($uuid)
    {
        $data = Kain_potongan::where('uuid', $uuid)->first();
        return response()->json($data);
    }

    public function update(Request $request, $uuid)
    {
        $this->validate($request, [
            'kain_roll_id'  => 'required',
            'ukuran'        => 'required|numeric|min:0'
        ]);

        Kain_potongan::where('id', $request->id)
        ->where('uuid', $uuid)
        ->update([
            'kain_roll_id'  => $request->kain_roll_id,
            'ukuran'        => $request->ukuran
        ]);

        return response()->json([
            'code'      => 200,
            'message'   => 'Berhasil ubah data Kain Potongan',
        ]);
    }

    public function delete($uuid)
    {
        $data = Kain_potongan::where('uuid', $uuid)->first();
        if($data){
            Kain_potongan::where('id', $data->id)->delete();

            return response()->json([
                'code' => 200,
                'message' => 'Berhasil Hapus data Kain Potongan',
            ]);
        }
        $kain_potongan = Kain_potongan::all();
        return view('kain_potongan.index', $kain_potongan);
    }
}
