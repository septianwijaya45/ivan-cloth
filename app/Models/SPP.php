<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPP extends Model
{
    use HasFactory;
    protected $table = 't_spps';
    protected $fillable = [
        'uuid', 'kode_spp', 'ukuran', 'kain_roll_id', 'karyawan_id', 'tanggal', 'berat', 'hasil_potongan', 'karyawan', 'gaji', 'status', 'note'
    ];

    public function kainRoll()
    {
        return $this->belongsTo(Kain_roll::class, 'kain_roll_id');
    }

    public function karyawans()
    {
        return $this->belongsToMany(Karyawan::class, 'karyawan_id');
    }

    public function SPK()
    {
        return $this->belongsToMany(SPK::class, 'spp_id');
    }

    
}
