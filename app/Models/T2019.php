<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T2019 extends Model
{
    use HasFactory;

    protected $table ='tlulus2020';
    protected $fillable =[
        'ind',
        'ing',
        'mtk',
        'fis',
        'kim',
        'bio',
        'sos',
        'geo',
        'eko',
        'kom',
        'lain',
        'rata',
    ];
}
