<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 't_pengeluarans';

    protected $fillable = [
        'uuid', 'kode_pengeluaran', 'jenis_pengeluaran', 'keperluan', 'total_uang', 'keterangan', 'tanggal', 'status'
    ];
}
