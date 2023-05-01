<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $table = 't_gajies';
    protected $fillable = [
        'uuid', 'karyawan_id', 'gaji', 'created_at', 'updated_at'
    ];
}
