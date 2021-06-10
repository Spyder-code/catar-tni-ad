<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
    use HasFactory;

    protected $table = 'calon';

    protected $fillable = [
        'no_online',
        'nama',
        'agama',
        'tem_lahir',
        'tgl_lahir',
        'suku',
        'alamat',
        'rt', 
        'rw',
        'no',
        'dsn',
        'ds',
        'kec',
        'kab', 
        'telp', 
        'daftar_ke', 
        'aspek_tl', 
    ];
}
