<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    protected $table = 'm_asets';

    protected $fillable = [
        'uuid', 'nama', 'kode', 'status', 'total_stok'
    ];
}
