<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kwitansi extends Model
{
    use HasFactory;

    protected $primaryKey = 'kw_id';

    protected $fillable = [
        'kw_id',
        'tgl',
        'hal',
        'nilai',
        'ppn',
        'pph21',
        'pph22',
        'pph23',
        'pdaerah',
        'sisa',
        'penerima_id',
        'anggaran_id',
        'file',
    ];

    // public function tempKwitansis()
    // {
    //     return $this->belongsTo(TempKwitansi::class);
    // }

    public function penerima()
    {
        return $this->belongsTo(Penerima::class);
    }

    public function anggaran()
    {
        return $this->belongsTo(Anggaran::class);
    }
}
