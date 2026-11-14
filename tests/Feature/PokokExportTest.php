<?php

namespace Tests\Feature;

use App\Exports\PokokExport;
use App\Models\Pokok;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Tests\TestCase;

class PokokExportTest extends TestCase
{
    public function test_export_writes_more_than_two_thousand_rows_with_filters(): void
    {
        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite.database', ':memory:');
        config()->set('excel.exports.chunk_size', 100);
        DB::purge('sqlite');

        require_once database_path('migrations/2020_06_10_171053_create_pokoks_table.php');
        (new \CreatePokoksTable)->up();

        for ($start = 1; $start <= 2105; $start += 250) {
            $rows = [];
            for ($i = $start; $i < min($start + 250, 2106); $i++) {
                $rows[] = [
                    'no_animo' => 'BA/' . str_pad((string) $i, 5, '0', STR_PAD_LEFT),
                    'no_online' => '082.' . str_pad((string) $i, 5, '0', STR_PAD_LEFT) . '/BA',
                    'nama' => 'Calon ' . $i,
                    'nik' => '0012345678901234',
                    'jalur_pendaftaran' => 'Mandiri',
                    'kdpanda' => 'Mojokerto',
                    'kodim' => 'KODIM 0814',
                ];
            }
            DB::table('pokok')->insert($rows);
        }
        DB::table('pokok')->insert([
            'no_animo' => 'TA/00001', 'nama' => 'CATA',
            'jalur_pendaftaran' => 'Lain', 'kdpanda' => 'Surabaya',
            'kodim' => 'KODIM 0814',
        ]);

        $filters = ['jenis' => 'CABA', 'jalur_pendaftaran' => 'Mandiri',
            'kdpanda' => 'Mojokerto', 'kodim' => 'KODIM 0814'];
        $this->assertSame(2105, Pokok::query()->filtered($filters)->count());
        $this->assertSame(1, Pokok::query()->filtered(['jenis' => 'CATA'])->count());
        $this->assertSame(1, Pokok::query()->filtered(['q' => 'Calon 2105'])->count());
        $this->assertSame(1, Pokok::query()->filtered(['q' => 'TA/00001'])->count());
        $this->assertSame(2105, Pokok::query()->filtered(['q' => '0012345678901234'])->count());
        $this->assertSame(1, (new PokokExport(['q' => 'Calon 2105', 'jenis' => 'CABA']))->query()->count());

        $file = tempnam(sys_get_temp_dir(), 'pokok-export-');
        try {
            file_put_contents($file, Excel::raw(new PokokExport($filters), \Maatwebsite\Excel\Excel::XLSX));
            $sheet = IOFactory::load($file)->getActiveSheet();
            $this->assertSame(2106, $sheet->getHighestDataRow());
            $this->assertSame('NO VALIDASI', $sheet->getCell('C1')->getValue());
            $this->assertSame('082.00001/BA', $sheet->getCell('C2')->getValue());
            $this->assertSame('0012345678901234', $sheet->getCell('E2')->getValue());
        } finally {
            unlink($file);
        }
    }
}
