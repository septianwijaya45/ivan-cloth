<?php

namespace App\Http\Controllers;

use App\Models\FileSPK;
use Illuminate\Http\Request;

class FilmSablonController extends Controller
{
    public function index()
    {
        return view('filmsablon.index');
    }

    public function indexData(Request $request)
    {
        $data = FileSPK::all();
        return response()->json($data);
    }
}
