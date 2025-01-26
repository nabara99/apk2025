<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pptk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip_pptk',
        'nama_pptk'
    ];
}
