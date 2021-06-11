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

    public function pendidikan()
    {
        return $this->hasOne(Pendidikan::class,'calon_id');
    }

    public function wali()
    {
        return $this->hasOne(Wali::class,'calon_id');
    }

    public function t2020()
    {
        return $this->hasOne(T2020::class,'calon_id');
    }
}
