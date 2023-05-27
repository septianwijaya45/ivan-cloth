<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JahitModel extends Model
{
    use HasFactory;
    
    protected $table = 't_jahits';
    protected $fillable = [
        'uuid', 'id','kode_spk', 'kode_jahit', 'artikel', 'tanggal', 'karyawan_id', 'karyawan', 'jumlah_jahit', 'satuan', 'gaji', 'note', 'status'
    ];
}
