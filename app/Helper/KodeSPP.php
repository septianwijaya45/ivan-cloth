<?php

use App\Models\SPP;
use Illuminate\Support\Facades\Date;

function kodeSPP()
{
    $tanggal = Date::now()->format('Y-m-d');
    $check = SPP::where('tanggal', 'LIKE', "%{$tanggal}%")->value('kode_spp');
    $kode = SPP::where('tanggal', 'LIKE', "%{$tanggal}%")->groupBy('kode_spp');

    if($check){
        $idNew = $kode->get()->count() + 1;

        $kodeLast = $kode->orderBy('id', 'DESC')->first();
        $getNumberCode = substr($kodeLast, -1);

        if($idNew == $getNumberCode){
            $idNew = $idNew + 1;
            return 'SPP|'.$tanggal.'|'.$idNew;
        }
        
        return 'SPP|'.$tanggal.'|'.$idNew;
    }else{
        $idNew = 1;
        return 'SPP|'.$tanggal.'|'.$idNew;
    }
}

?>