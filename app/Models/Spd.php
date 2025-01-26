<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spd extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_spd',
        'spd_tgl',
        'jenis',
        'spd_uraian',
        'spd_nilai',
        'iwp1',
        'iwp8',
        'pph21',
        'pph22',
        'pph23',
        'ppn',
    ];
}
