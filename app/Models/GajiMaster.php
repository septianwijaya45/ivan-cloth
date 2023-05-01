<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiMaster extends Model
{
    use HasFactory;
    protected $table = 'm_gajis';
    protected $fillable = [
        'uuid', 'gaji', 'created_at', 'updated_at'
    ];
}
