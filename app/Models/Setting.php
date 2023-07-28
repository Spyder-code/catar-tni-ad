<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'pendaftaran',
        'heading_1',
        'heading_2',
        'content',
        'dik',
        'tertua',
        'termuda',
        'lp_heading',
        'lp_title_santri',
        'lp_title_reguler',
        'lihat_umur',
        'label_ponpes',
        'label_alamat_ponpes',
        'label_kabupaten_ponpes',
    ];
}
