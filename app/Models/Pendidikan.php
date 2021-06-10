<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;

    protected $table = 'pendidikan';

    protected $fillable = [
        'calon_id',
        'sd',
        'l_sd',
        'smp',
        'l_smp',
        'sma',
        'nama_sma',
        'l_sma',
        'jur', 
        'jumlah_nuan', 
        'rata', 
    ];
}
