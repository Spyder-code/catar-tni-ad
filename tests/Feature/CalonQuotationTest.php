<?php

namespace Tests\Feature;

use App\Exports\CalonExport;
use App\Http\Requests\CalonRequest;
use App\Models\Calon;
use App\Models\Pokok;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel as ExcelFacade;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Tests\TestCase;

class CalonQuotationTest extends TestCase
{
    public function test_quotation_marks_survive_validation_database_view_and_excel(): void
    {
        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite.database', ':memory:');
        DB::purge('sqlite');

        foreach ([
            '2020_06_10_171053_create_pokoks_table.php' => 'CreatePokoksTable',
            '2021_06_04_145948_create_calons_table.php' => 'CreateCalonsTable',
            '2021_06_04_150418_create_pendidikans_table.php' => 'CreatePendidikansTable',
            '2021_06_04_150646_create_walis_table.php' => 'CreateWalisTable',
            '2021_06_10_173837_create_t2020_s_table.php' => 'CreateT2020STable',
            '2021_06_15_125307_create_t2019_s_table.php' => 'CreateT2019STable',
            '2021_06_27_170009_create_settings_table.php' => 'CreateSettingsTable',
        ] as $file => $class) {
            require_once database_path('migrations/' . $file);
            (new $class)->up();
        }
        require_once database_path('migrations/update/2022_07_01_045919_update_wali_table.php');
        (new \UpdateWaliTable)->up();
        DB::table('settings')->insert(['id' => 1, 'dik' => '2026-01-01',
            'tertua' => '2000-01-01', 'termuda' => '2010-01-01']);

        $pokok = Pokok::create([
            'no_online' => 'VALID-1', 'nama' => "O'Brien", 'tem_lahir' => 'Kota',
            'agama' => 'Islam', 'suku' => 'Jawa',
        ]);
        $this->be($pokok, 'calon');

        $payload = ['pokok_id' => $pokok->id, 'calon' => [], 'pendidikan' => [],
            'wali' => [], 'nilai' => [], 'nilai2019' => []];
        foreach ((new CalonRequest)->rules() as $field => $rules) {
            if (str_contains($rules, 'required')) {
                data_set($payload, $field, "O'Brien \"Junior\"");
            }
        }
        $payload['calon']['no_online'] = 'VALID-1';
        $payload['calon']['ktp'] = '1234567890123456';
        $payload['calon']['tgl_lahir'] = '2005-01-01';
        $payload['pendidikan']['l_sd'] = 2017;
        $payload['pendidikan']['l_smp'] = 2020;
        $payload['pendidikan']['l_sma'] = 2023;
        $payload['wali']['status_wali'] = 1;

        $this->post('/calon/administrasi', $payload)->assertSessionHasNoErrors()->assertSessionHas('success');
        $this->post('/calon/administrasi', $payload)->assertSessionHasNoErrors()->assertSessionHas('success');

        $calon = Calon::with(['wali', 'pendidikan'])->findOrFail($pokok->id);
        $this->assertSame("O'Brien \"Junior\"", $calon->nama);
        $this->assertSame("O'Brien \"Junior\"", $calon->wali->ayah);
        $this->assertSame("O'Brien \"Junior\"", $calon->pendidikan->sd);

        $this->get('/calon/administrasi')
            ->assertOk()
            ->assertSee('value="O&#039;Brien &quot;Junior&quot;"', false);

        $html = view('export.calon', ['data' => collect([$calon])])->render();
        $this->assertStringContainsString('O&#039;Brien &quot;Junior&quot;', $html);
        $this->assertStringNotContainsString("O\\'Brien", $html);

        $file = tempnam(sys_get_temp_dir(), 'calon-export-');
        try {
            file_put_contents($file, ExcelFacade::raw(new CalonExport([$pokok->id]), Excel::XLSX));
            $sheet = IOFactory::load($file)->getActiveSheet();
            $this->assertSame("O'Brien \"Junior\"", $sheet->getCell('D2')->getValue());
        } finally {
            unlink($file);
        }
    }
}
