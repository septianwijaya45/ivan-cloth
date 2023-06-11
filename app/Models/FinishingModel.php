<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishingModel extends Model
{
    use HasFactory;

    protected $table = 't_finishings';
    protected $fillable = [
        'uuid', 'id', 'jahit_id', 'kode_finishing', 'artikel', 'tanggal', 'karyawan_id', 'karyawan', 'jumlah_finishing', 'satuan', 'gaji', 'note', 'status'
    ];
}
