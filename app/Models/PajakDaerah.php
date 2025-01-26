<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PajakDaerah extends Model
{
    use HasFactory;

    protected $fillable = [
        'uraian_daerah',
        'spd_id',
        'no_sptpd',
        'ntpn_daerah',
        'tgl_bayar',
        'kwitan_id',
        'ntb',
    ];

    public function kwitansi()
    {
        return $this->belongsTo(Kwitansi::class);
    }
}
