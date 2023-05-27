<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPKDetail extends Model
{
    use HasFactory;
    protected $table = 't_spk_details';
    protected $fillable = [
        'id', 't_spk_id', 'kode_spk', 'kain_potongan_id', 'quantity', 'satuan', 'karyawan_id', 'karyawan', 'gaji'
    ];

    public function spk_detail()
    {
        return $this->belongsToMany(SPK::class, 't_spk_id');
    }
}
