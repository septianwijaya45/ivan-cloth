<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileSPK extends Model
{
    use HasFactory;
    protected $table = 't_spp_files';
    protected $fillable = [
        'uuid', 'kode_spk', 'nama_foto', 'created_at', 'updated_at'
    ];
}
