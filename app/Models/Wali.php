<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali extends Model
{
    use HasFactory;

    protected $table = 'wali';
    protected $fillable = [
        'calon_id',
        'ayah',
        'a_kerja',
        'a_pkt',
        'a_jab',
        'a_sat',
        'ibu',
        'i_kerja',
        'i_pkt',
        'i_jab',
        'i_sat',
        'o_telp',
        'o_alamat',
        'wali',
        'w_kerja',
        'w_pkt',
        'w_jab',
        'w_sat',
        'w_telp',
        'w_alamat',
        'status_wali',
        'hub_calon_wali',
    ];
}
