<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_penerima',
        'jabatan_penerima',
        'alamat',
        'bank',
        'rek_bank',
        'npwp'
    ];
}
