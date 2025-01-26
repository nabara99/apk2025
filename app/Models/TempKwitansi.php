<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempKwitansi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kwitansi_id',
        'anggaran_id',
        'total',
    ];

    public function kwitansi()
    {
        return $this->belongsTo(Kwitansi::class);
    }
}
