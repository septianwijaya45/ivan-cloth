<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukuran extends Model
{
    use HasFactory;
    protected $table = 'm_ukurans';
    protected $fillable = [
        'uuid', 'ukuran', 'created_at', 'updated_at'
    ];
}