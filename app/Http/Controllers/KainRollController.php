<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kain_roll;
use Illuminate\Http\Request;

class KainRollController extends Controller
{
    public function index()
    {
        $kain_roll = Kain_roll::all();
        
        return view('kain_roll.index',$kain_roll);
    }
}
