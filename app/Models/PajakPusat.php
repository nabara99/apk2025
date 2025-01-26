<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PajakPusat extends Model
{
    use HasFactory;

    protected $fillable = [
        'uraian_pajak',
        'spd_id',
        'kwi_id',
        'ntpn',
        'tgl_setor',
        'ntb',
    ];
}
