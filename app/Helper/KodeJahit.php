<?php

use App\Models\JahitModel;
use App\Models\SPK;
use Illuminate\Support\Facades\Date;

function kodeJahit()
{
    $tanggal = Date::now()->format('Y-m-d');
    $check = JahitModel::where('tanggal', 'LIKE', "%{$tanggal}%")->value('kode_jahit');
    $kode = JahitModel::where('tanggal', 'LIKE', "%{$tanggal}%")->groupBy('kode_jahit');

    if($check){
        $idNew = $kode->get()->count() + 1;

        $kodeLast = $kode->orderBy('id', 'DESC')->first();
        $getNumberCode = substr($kodeLast, -1);

        if($idNew == $getNumberCode){
            $idNew = $idNew + 1;
            return 'JAHIT|'.$tanggal.'|'.$idNew;
        }
        
        return 'JAHIT|'.$tanggal.'|'.$idNew;
    }else{
        $idNew = 1;
        return 'JAHIT|'.$tanggal.'|'.$idNew;
    }
}

?>