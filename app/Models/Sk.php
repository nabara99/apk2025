<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sk extends Model
{
    use HasFactory;

    use HasUlids;

    protected $fillable = [
        'name_sk',
        'number_sk',
        'date_sk',
        'signer',
        'scan'
    ];
}
