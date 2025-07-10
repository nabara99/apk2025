<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PajakKwitansi extends Model
{
    use HasFactory;

    protected $fillable = [
        'spd_id',
        'kwi_id',
        'kwitu_id',
        'uraian_pajak',
        'billing',
        'ntpn',
        'tgl_setor',
        'ntb',
        'nilai_pajak',
        'jenis_pajak',
    ];
}
