<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T2019 extends Model
{
    use HasFactory;

    protected $table = 'tlulus2019';

    protected $fillable = [
        'kunci',
        'nodaf',
        'nama' ,
        'b_indo',
        'b_ing',
        'mat',
        'fis',
        'kim',
        'bio',
        'sos',
        'geo',
        'eko',
        'komp',
        'lain',
        'jnuan',
        'rata',
    ];
}
