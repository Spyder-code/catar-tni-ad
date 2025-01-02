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
        'kab_sd',
        'smp',
        'l_smp',
        'kab_smp',
        'sma',
        'almt_sma',
        'nama_sma',
        'l_sma',
        'kab_sma',
        'jur',
        'jumlah_nuan',
        'rata',
        'ponpes',
        'alamat_ponpes',
        'kabupaten_ponpes',
        'nisnsd',
        'nisnsmp',
        'nisnsma',
    ];
}
