<?php

namespace Tests\Unit;

use App\Imports\PokokImport;
use App\Models\Pokok;
use PHPUnit\Framework\TestCase;

class PokokImportTest extends TestCase
{
    public function test_import_maps_a_spreadsheet_row_to_pokok(): void
    {
        $model = (new PokokImport)->model([123, 'ONLINE-123', 'Calon Uji']);

        $this->assertInstanceOf(Pokok::class, $model);
        $this->assertSame('ONLINE-123', $model->no_online);
        $this->assertSame('Calon Uji', $model->nama);
    }
}
