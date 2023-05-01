<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kain_potongan extends Model
{
    protected $table = 'm_kain_potongans';

    protected $fillable = [
        'uuid', 'id', 'kain_roll_id', 'ukuran', 'created_at', 'updated_at'
    ];

    public function spk()
    {
        return $this->hasMany(SPK::class);
    }
}
