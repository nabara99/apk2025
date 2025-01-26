<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpdRinci extends Model
{
    use HasFactory;

    protected $fillable = [
        'spd_id',
        'anggaran_id',
        'total'
    ];
}
