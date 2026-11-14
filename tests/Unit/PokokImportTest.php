<?php

namespace Tests\Unit;

use App\Imports\PokokImport;
use App\Models\Pokok;
use PHPUnit\Framework\TestCase;

class PokokImportTest extends TestCase
{
    public function test_import_maps_excel_columns_without_using_its_row_number_as_id(): void
    {
        $row = [
            1, 'BA/00001/MOJOKERTO', '082.00006/BA', 'BILLY ARYA WARDANA',
            '3517121308070002', 'JOMBANG', '13-08-2007', 'ISLAM', 'JAWA',
            'Alamat calon', 171, 61, 'AMIANTO', 'KARYAWAN SWASTA',
            '085608326005', 'SMA', 'SMA NEGERI MOJOAGUNG', 'IPA', 2026,
            '085645398130', 'aryabilly25@gmail.com', 'CABA PK',
            'Mendaftar Sendiri', 'Mojokerto', 'Kodam V/Brw',
            'KODIM 0814/JOMBANG', null, null,
            'Tervalidasi / Sedang Seleksi', '08-10-2026 11:54',
        ];

        $model = (new PokokImport)->model($row);

        $this->assertInstanceOf(Pokok::class, $model);
        $this->assertNull($model->id);
        $this->assertSame('BA/00001/MOJOKERTO', $model->no_animo);
        $this->assertSame('082.00006/BA', $model->no_online);
        $this->assertSame('3517121308070002', $model->nik);
        $this->assertSame('13-08-2007', $model->tgl_lahir);
        $this->assertSame('085608326005', $model->no_hp_ortu);
        $this->assertSame('Mojokerto', $model->kdpanda);
        $this->assertSame('08-10-2026 11:54', $model->tanggal_validasi);
        $this->assertNull($model->koramil);
    }

    public function test_unvalidated_row_keeps_no_online_empty_and_blank_rows_are_skipped(): void
    {
        $row = [null, 'BA/00004/MOJOKERTO', null, 'MUHAMMAD ROFIQ SYARIFUDDIN'];

        $model = (new PokokImport)->model($row);

        $this->assertSame('BA/00004/MOJOKERTO', $model->no_animo);
        $this->assertNull($model->no_online);
        $this->assertNull((new PokokImport)->model([]));
    }
}
