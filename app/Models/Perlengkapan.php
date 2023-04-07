<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perlengkapan extends Model
{
    protected $table = 'm_perlengkapans';

    protected $fillable = [
        'uuid', 'nama', 'total_stok'
    ];
}
