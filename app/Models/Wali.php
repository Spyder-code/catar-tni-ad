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
        'a_kakek',
        'i_kakek',
        'a_nenek',
        'i_nenek',
        'a_kerja',
        'a_pkt',
        'a_jab',
        'a_sat',
        'ibu',
        'i_kerja',
        'i_pkt',
        'i_jab',
        'i_sat',
        'wali_ayah',
        'wa_kerja',
        'wa_pkt',
        'wa_jab',
        'wa_sat',
        'wali_ibu',
        'wi_kerja',
        'wi_pkt',
        'wi_jab',
        'wi_sat',
        'o_telp',
        'o_alamat',
        'w_telp',
        'w_alamat',
        'status_wali',
        'hub_calon_wali',
    ];
}
