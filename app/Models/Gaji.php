<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $table = 'm_gajies';
    protected $fillable = [
        'uuid', 'gaji', 'created_at', 'updated_at'
    ];
}
