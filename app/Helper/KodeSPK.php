<?php

use App\Models\SPK;
use Illuminate\Support\Facades\Date;

function kodeSPK()
{
    $tanggal = Date::now()->format('Y-m-d');
    $check = SPK::where('tanggal', 'LIKE', "%{$tanggal}%")->value('kode_spk');
    $kode = SPK::where('tanggal', 'LIKE', "%{$tanggal}%")->groupBy('kode_spk');

    if($check){
        $idNew = $kode->get()->count() + 1;

        $kodeLast = $kode->orderBy('id', 'DESC')->first();
        $getNumberCode = substr($kodeLast, -1);

        if($idNew == $getNumberCode){
            $idNew = $idNew + 1;
            return 'SPK|'.$tanggal.'|'.$idNew;
        }
        
        return 'SPK|'.$tanggal.'|'.$idNew;
    }else{
        $idNew = 1;
        return 'SPK|'.$tanggal.'|'.$idNew;
    }
}

?>