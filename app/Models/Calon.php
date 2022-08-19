<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
    use HasFactory;

    protected $table = 'calon';

    protected $fillable = [
        'id',
        'no_online',
        'ktp',
        'no_kk',
        'nama',
        'agama',
        'tem_lahir',
        'tgl_lahir',
        'u_hri',
        'u_bln',
        'u_thn',
        'l_hri',
        'l_bln',
        'l_thn',
        'umr',
        'ket_umr',
        'dik',
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
        'keahlian',
        'prestasi_provinsi',
        'prestasi_nasional',
        'tb',
        'bb',
        'tindik',
        'tatto',
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

    public function t2019()
    {
        return $this->hasOne(T2019::class,'calon_id');
    }
}
