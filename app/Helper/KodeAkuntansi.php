<?php

use App\Models\Pemasukkan;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Date;

function kodePemasukkan(){
    $tgl = Date::now()->format('d');
    $bln = Date::now()->format('F');
    $thn = Date::now()->format('Y');

    $tanggal = Date::now()->format('Y-m-d');
    $check = Pemasukkan::where('tanggal', 'LIKE', "%{$tanggal}%")->value('kode_pemasukan');
    $kode = Pemasukkan::where('tanggal', 'LIKE', "%{$tanggal}%")->groupBy('kode_pemasukan');
    
    if($check){
        $idNew = $kode->get()->count() + 1;

        $kodeLast = $kode->orderBy('id', 'DESC')->first();
        $getNumberCode = substr($kodeLast, -1);

        if($idNew == $getNumberCode){
            $idNew = $idNew + 1;
            return 'INV.'.$tgl.'.'.$bln.'.'.$thn.'.'.$idNew;
        }
        
        return 'INV.'.$tgl.'.'.$bln.'.'.$thn.'.'.$idNew;
    }else{
        $idNew = 1;
        return 'INV.'.$tgl.'.'.$bln.'.'.$thn.'.'.$idNew;
    }
}

function kodePengeluaran(){
    $tgl = Date::now()->format('d');
    $bln = Date::now()->format('F');
    $thn = Date::now()->format('Y');

    $tanggal = Date::now()->format('Y-m-d');
    $check = Pengeluaran::where('tanggal', 'LIKE', "%{$tanggal}%")->value('kode_pengeluaran');
    $kode = Pengeluaran::where('tanggal', 'LIKE', "%{$tanggal}%")->groupBy('kode_pengeluaran');
    
    if($check){
        $idNew = $kode->get()->count() + 1;

        $kodeLast = $kode->orderBy('id', 'DESC')->first();
        $getNumberCode = substr($kodeLast, -1);

        if($idNew == $getNumberCode){
            $idNew = $idNew + 1;
            return 'INV-OUT.'.$tgl.'.'.$bln.'.'.$thn.'.'.$idNew;
        }
        
        return 'INV-OUT.'.$tgl.'.'.$bln.'.'.$thn.'.'.$idNew;
    }else{
        $idNew = 1;
        return 'INV-OUT.'.$tgl.'.'.$bln.'.'.$thn.'.'.$idNew;
    }
}

?>