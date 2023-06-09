<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'm_karyawans';

    protected $fillable = [
        'uuid', 'nama', 'jenis_kelamin', 'nik', 'no_telepon', 'npwp', 'posisi', 'status_karyawan', 'gaji_pokok'
    ];

    public function SPP()
    {
        return $this->belongsToMany(SPP::class, 'karyawan_id');
    }

    public function SPK()
    {
        return $this->belongsToMany(SPK::class, 'karyawan_id');
    }
}
