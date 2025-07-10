<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempKwitansiTu extends Model
{
    use HasFactory;

    protected $fillable = [
        'kwitansi_id',
        'anggaran_id',
        'total',
    ];

    public function kwitansiTu()
    {
        return $this->belongsTo(KwitansiTu::class);
    }

    public function anggaran()
    {
        return $this->belongsTo(Anggaran::class);
    }
}
