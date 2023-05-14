<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kain_roll extends Model
{
    protected $table = 'm_kain_rolls';

    protected $fillable = [
        'uuid', 'kode_lot', 'jenis_kain', 'stok_roll', 'berat', 'warna'
    ];

    public function spp()
    {
        return $this->hasMany(SPP::class);
    }
}
