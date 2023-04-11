<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Kain_roll;
use App\Models\Karyawan;
use App\Models\SPP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SPPController extends Controller
{
    public function index()
    {
        return view('spp.index');
    }

    public function indexData(Request $request)
    {
        $data = SPP::select('kode_spp', DB::raw('COUNT(*) as total'))->groupBy('kode_spp')->get();
        return response()->json($data);
    }

    public function insert()
    {
        $kainroll   = Kain_roll::all();
        $karyawan   = Karyawan::where('posisi', 'pemotong')->get();
        $gaji       = Gaji::all();
        return view('spp.insert');
    }

    public function store(Request $request)
    {
        # code...
    }

    public function edit($kode_spp)
    {
        # code...
    }

    public function update(Request $request, $kode_spp)
    {
        # code...
    }

    public function deleteInsertorEdit($id)
    {
        # code...
    }

    public function delete($kode_spp)
    {
        # code...
    }
}
