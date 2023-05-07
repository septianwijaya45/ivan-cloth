<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukkan extends Model
{
    use HasFactory;
    
    protected $table = 't_pemasukans';

    protected $fillable = [
        'uuid', 'kode_pemasukkan', 'jenis_penjualan', 'pemasukkan', 'total_uang', 'keterangan', 'tanggal', 'status'
    ];
}
