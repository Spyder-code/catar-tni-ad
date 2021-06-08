<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;

class Pokok extends Model
{
    use HasFactory;

    protected $table = 'pokok';

    protected $fillable = [
        'id',
        'no_online',
        'nama',
        'tem_lahir',
        'tgl_lahir',
        'kdpanda',
        'tb',
        'bb',
        'suku',
        'agama',
        'ortu1',
        'wali1',
        'alamat_c',
        'alamat_o',
        'jenis sekolah',
        'nama_sekolah',
        'jur',
        'th_lulus',
        'kerja',
    ];

    public $timestamps = false;
}
