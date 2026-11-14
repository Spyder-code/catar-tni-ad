<?php

namespace App\Imports;

use App\Models\Pokok;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PokokImport implements ToModel, WithStartRow
{
    public function model(array $row): Model|array|null
    {
        // Kolom A (NO) hanya nomor urut Excel, bukan primary key pokok.
        if (empty(trim((string) ($row[1] ?? ''))) && empty(trim((string) ($row[3] ?? '')))) {
            return null;
        }

        $columns = [
            'no_animo' => 1,
            'no_online' => 2, // NO VALIDASI
            'nama' => 3,
            'nik' => 4,
            'tem_lahir' => 5,
            'tgl_lahir' => 6,
            'agama' => 7,
            'suku' => 8,
            'alamat_c' => 9,
            'tb' => 10,
            'bb' => 11,
            'ortu1' => 12,
            'kerja' => 13,
            'no_hp_ortu' => 14,
            'jenis_sekolah' => 15,
            'nama_sekolah' => 16,
            'jur' => 17,
            'th_lulus' => 18,
            'no_telp_wa' => 19,
            'email' => 20,
            'jenis_pendaftaran' => 21,
            'jalur_pendaftaran' => 22,
            'kdpanda' => 23,
            'kodam' => 24,
            'kodim' => 25,
            'koramil' => 26,
            'babinsa' => 27,
            'status' => 28,
            'tanggal_validasi' => 29,
        ];

        $attributes = [];
        foreach ($columns as $column => $index) {
            $value = $row[$index] ?? null;
            $attributes[$column] = $value === null || trim((string) $value) === ''
                ? null
                : trim((string) $value);
        }

        return new Pokok($attributes);
    }

    public function startRow(): int
    {
        return 2;
    }
}
