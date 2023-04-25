<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPK extends Model
{
    use HasFactory;
    protected $table = 't_spks';
    protected $fillable = [
        'uuid', 'spp_id', 'kode_spk', 'kain_potongan_id', 'artikel', 'karyawan_id', 'karyawan', 'jumlah_kain', 'satuan', 'ukuran', 'gaji', 'status', 'note'
    ];

    public function karyawans()
    {
        return $this->belongsToMany(Karyawan::class, 'karyawan_id');
    }
    
    public function kainPotongan()
    {
        return $this->belongsTo(Kain_potongan::class, 'kain_potongan_id');
    }

    public function spp()
    {
        return $this->belongsToMany(SPP::class, 'karyawan_id');
    }
}
