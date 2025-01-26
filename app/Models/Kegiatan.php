<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_kegiatan',
        'nama_kegiatan',
        'program_id',
        'pptk_id',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function pptk()
    {
        return $this->belongsTo(Pptk::class);
    }
}
