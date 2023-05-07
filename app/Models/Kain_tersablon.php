<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kain_tersablon extends Model
{
    protected $table = 'm_kain_tersablons';

    protected $fillable = [
        'uuid', 'id', 'kain_potongan_id', 'stok', 'ukuran', 'created_at', 'updated_at'
    ];
}
