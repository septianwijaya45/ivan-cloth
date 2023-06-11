<?php

use App\Models\FinishingModel;
use Illuminate\Support\Facades\Date;

function kodeFinishing()
{
    $tanggal = Date::now()->format('Y-m-d');
    $check = FinishingModel::where('tanggal', 'LIKE', "%{$tanggal}%")->value('kode_finishing');
    $kode = FinishingModel::where('tanggal', 'LIKE', "%{$tanggal}%")->groupBy('kode_finishing');

    if ($check) {
        $idNew = $kode->get()->count() + 1;

        $kodeLast = $kode->orderBy('id', 'DESC')->first();
        $getNumberCode = substr($kodeLast, -1);

        if ($idNew == $getNumberCode) {
            $idNew = $idNew + 1;
            return 'FNSH|' . $tanggal . '|' . $idNew;
        }

        return 'FNSH|' . $tanggal . '|' . $idNew;
    } else {
        $idNew = 1;
        return 'FNSH|' . $tanggal . '|' . $idNew;
    }
}
