<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukkan extends Model
{
    use HasFactory;
    
    protected $table = 't_pemasukans';

    protected $fillable = [
        'uuid', 'kode_pemasukkan', 'metode_pembayaran', 'total_uang', 'tanggal', 'status'
    ];
}
