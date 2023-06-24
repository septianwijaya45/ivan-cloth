<?php

namespace App\Http\Controllers;

use App\Models\FinishingModel;
use App\Models\Jahit;
use App\Models\SPK;
use App\Models\SPP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
            $totSPP = count(SPP::where('status', 'Selesai Dikerjakan')->get());
            $totSPK = count(SPK::where('status', 'Selesai Dikerjakan')->get());
            $totJahit = count(Jahit::where('status', 'Selesai Dikerjakan')->get());
            $totFinishing = count(FinishingModel::where('status', 'Selesai Dikerjakan')->get());

            $spp = SPP::select('kode_spp', DB::raw('COUNT(*) as total'), 'status')->where('status', 'Belum Dikerjakan')->limit(5)->groupBy('kode_spp')->get();
            $spk = SPK::select('kode_spk', DB::raw('COUNT(*) as total'), 'status')->where('status', 'Belum Dikerjakan')->limit(5)->groupBy('kode_spk')->get();
            $jahit = Jahit::select('kode_jahit', DB::raw('COUNT(*) as total'), 'status')->where('status', 'Belum Dikerjakan')->limit(5)->groupBy('kode_jahit')->get();
            $finishing = FinishingModel::select('kode_finishing', DB::raw('COUNT(*) as total'), 'status')->where('status', 'Belum Dikerjakan')->limit(5)->groupBy('kode_finishing')->get();


            return view('dashboard.index', compact(['totSPP', 'totSPK', 'totJahit', 'totFinishing', 'spp', 'spk', 'jahit', 'finishing']));
        }else{
            $totSPP = count(SPP::where('status', 'Sedang Dikerjakan')->get());
            $totSPK = count(SPK::where('status', 'Sedang Dikerjakan')->get());
            $totJahit = count(Jahit::where('status', 'Sedang Dikerjakan')->get());
            $totFinishing = count(FinishingModel::where('status', 'Sedang Dikerjakan')->get());

            return view('dashboard.index', compact(['totSPP', 'totSPK', 'totJahit', 'totFinishing']));
        }
    }
}
