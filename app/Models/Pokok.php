<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;

class Pokok extends Model
{
    use HasFactory;

    public const EXCEL_COLUMNS = [
        'no_animo' => 'NO ANIMO', 'no_online' => 'NO VALIDASI',
        'nama' => 'NAMA', 'nik' => 'NIK', 'tem_lahir' => 'TEMPAT LAHIR',
        'tgl_lahir' => 'TANGGAL LAHIR', 'agama' => 'AGAMA', 'suku' => 'SUKU',
        'alamat_c' => 'ALAMAT', 'tb' => 'TINGGI BADAN', 'bb' => 'BERAT BADAN',
        'ortu1' => 'NAMA ORANG TUA', 'kerja' => 'PEKERJAAN ORANG TUA',
        'no_hp_ortu' => 'NO HP ORANG TUA', 'jenis_sekolah' => 'PENDIDIKAN TERAKHIR',
        'nama_sekolah' => 'NAMA SEKOLAH', 'jur' => 'JURUSAN',
        'th_lulus' => 'TAHUN LULUS', 'no_telp_wa' => 'NO TELP / WA',
        'email' => 'EMAIL', 'jenis_pendaftaran' => 'JENIS PENDAFTARAN',
        'jalur_pendaftaran' => 'JALUR PENDAFTARAN', 'kdpanda' => 'PANDA',
        'kodam' => 'KODAM', 'kodim' => 'KODIM', 'koramil' => 'KORAMIL',
        'babinsa' => 'BABINSA', 'status' => 'STATUS',
        'tanggal_validasi' => 'TANGGAL VALIDASI',
    ];

    protected $table = 'pokok';

    public function scopeFiltered($query, array $filters)
    {
        $search = trim($filters['q'] ?? '');
        if ($search !== '') {
            $query->where(function ($query) use ($search) {
                foreach (['no_animo', 'no_online', 'nama', 'nik', 'email',
                    'no_telp_wa', 'no_hp_ortu', 'tem_lahir', 'nama_sekolah',
                    'kodim', 'kdpanda'] as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            });
        }

        if (in_array($filters['jenis'] ?? null, ['CABA', 'CATA'], true)) {
            $prefix = $filters['jenis'] === 'CABA' ? 'BA' : 'TA';
            $query->where('no_animo', 'like', $prefix . '%');
        }

        foreach (['jalur_pendaftaran', 'kdpanda', 'kodim'] as $column) {
            if (!empty($filters[$column])) {
                $query->where($column, $filters[$column]);
            }
        }

        return $query;
    }

    public function calon()
    {
        return $this->hasOne(Calon::class, 'id', 'id');
    }

    protected $fillable = [
        'no_animo',
        'no_online',
        'nama',
        'nik',
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
        'jenis_sekolah',
        'nama_sekolah',
        'jur',
        'th_lulus',
        'kerja',
        'no_hp_ortu',
        'no_telp_wa',
        'email',
        'jenis_pendaftaran',
        'jalur_pendaftaran',
        'kodam',
        'kodim',
        'koramil',
        'babinsa',
        'status',
        'tanggal_validasi',
    ];
}
