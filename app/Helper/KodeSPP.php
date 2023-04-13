<?php

use App\Models\SPP;
use Illuminate\Support\Facades\Date;

function kodeSPP()
{
    $tanggal = Date::now()->format('d-m-Y');
    $check = SPP::where('kode_spp', 'LIKE', '%{$tanggal}%')->value('kode_spp');
    $kode = SPP::where('kode_spp', 'LIKE', '%{$tanggal}%')->groupBy('kode_spp');

    if($check){
        $idNew = $kode->count() + 1;

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