<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPP extends Model
{
    use HasFactory;
    protected $table = 't_spps';
    protected $fillable = [
        'uuid', 'kain_roll_id', 'kode_spp', 'karyawan_id', 'jumlah_roll', 'hasil_potongan', 'status', 'created_at', 'updated_at'
    ];

    public function kainRoll()
    {
        return $this->belongsTo(Kain_roll::class, 'kain_roll_id');
    }

    public function karyawans()
    {
        return $this->belongsToMany(Karyawan::class, 'karyawan_id');
    }

    
}
