<?php

namespace App\Imports;

use App\Models\Pokok as ModelsPokok;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PokokImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ModelsPokok([
            'id' => $row[0],
            'no_online' => $row[1],
            'nama' => $row[2],
            'tem_lahir' => $row[3],
            'tgl_lahir' => $row[4],
            'kdpanda' => $row[5],
            'tb' => $row[6],
            'bb' => $row[7],
            'suku' => $row[8],
            'agama' => $row[9],
            'ortu1' => $row[10],
            'wali1' => $row[11],
            'alamat_c' => $row[12],
            'alamat_o' => $row[13],
            'jenis_sekolah' => $row[14],
            'nama_sekolah' => $row[15],
            'jur' => $row[16],
            'th_lulus' => $row[17],
            'kerja' => $row[18],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
