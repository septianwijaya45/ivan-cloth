<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangJadi extends Model
{
    use HasFactory;
    protected $table = "m_barang_jadies";
    protected $fillable = [
        'uuid', 'finishing_id', 'artikel', 'tanggal', 'total_barang', 'status'
    ];
}
