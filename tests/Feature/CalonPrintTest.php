<?php

namespace Tests\Feature;

use App\Models\Calon;
use App\Models\Pendidikan;
use App\Models\Pokok;
use App\Models\T2020;
use App\Models\User;
use App\Models\Wali;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CalonPrintTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite.database', ':memory:');
        DB::purge('sqlite');

        require_once database_path('migrations/2014_10_12_000000_create_users_table.php');
        require_once database_path('migrations/2020_06_10_171053_create_pokoks_table.php');
        (new \CreateUsersTable)->up();
        (new \CreatePokoksTable)->up();
        (require database_path('migrations/2026_11_14_000001_add_admin_roles_to_users.php'))->up();
        (require database_path('migrations/2026_11_14_000002_add_nrp_to_users.php'))->up();
        require_once database_path('migrations/2021_06_04_145948_create_calons_table.php');
        require_once database_path('migrations/2021_06_04_150418_create_pendidikans_table.php');
        require_once database_path('migrations/2021_06_04_150646_create_walis_table.php');
        require_once database_path('migrations/2021_06_10_173837_create_t2020_s_table.php');
        require_once database_path('migrations/2021_06_15_125307_create_t2019_s_table.php');
        require_once database_path('migrations/2021_06_27_170009_create_settings_table.php');
        (new \CreateCalonsTable)->up();
        (new \CreatePendidikansTable)->up();
        (new \CreateWalisTable)->up();
        (new \CreateT2020STable)->up();
        (new \CreateT2019STable)->up();
        (new \CreateSettingsTable)->up();
        DB::table('settings')->insert(['id' => 1]);

        $pokok1 = Pokok::create([
            'id' => 1,
            'no_animo' => 'BA/00001/MOJOKERTO',
            'no_online' => '082.00001/TA',
            'nama' => 'Rendi Ariel Firdhaus',
            'nik' => '3517122810050001',
            'tem_lahir' => 'Mojokerto',
            'tgl_lahir' => '28-10-2005',
            'agama' => 'Islam',
            'suku' => 'Jawa',
            'tb' => '166',
            'bb' => '70',
            'ortu1' => 'Karjono',
            'jenis_sekolah' => 'SMK',
            'jur' => 'Teknik Elektro Industri',
            'th_lulus' => '2023',
            'kodim' => 'KODIM 0814/JOMBANG',
        ]);

        Calon::create([
            'id' => 1,
            'no_online' => '082.00001/TA',
            'nama' => 'Rendi Ariel Firdhaus',
            'ktp' => '3517122810050001',
            'tem_lahir' => 'Mojokerto',
            'tgl_lahir' => '2005-10-28',
            'suku' => 'Jawa',
            'agama' => 'Islam',
            'tb' => '166',
            'bb' => '70',
            'alamat' => 'Ds Mojorejo Kec Jetis Kab/kota Mojokerto',
        ]);

        Pendidikan::create([
            'calon_id' => 1,
            'sma' => 'SMK Negeri 1 Mojokerto',
            'jur' => 'Teknik Elektro Industri',
            'l_sma' => 2023,
            'rata' => '81.99',
        ]);

        Wali::create([
            'calon_id' => 1,
            'ayah' => 'Karjono',
            'o_alamat' => 'Dsn.pantesrejo Ds.mojorejo Rt.01 Rw.04 Kec.jetis Kab.mojokerto',
        ]);

        T2020::create([
            'calon_id' => 1,
            'rata_akhir' => '81.99',
        ]);

        // Calon 2 for Bojonegoro
        Pokok::create([
            'id' => 2,
            'no_animo' => 'BA/00002/MOJOKERTO',
            'no_online' => '082.00002/TA',
            'nama' => 'Calon Bojonegoro',
            'kodim' => 'KODIM 0813/BOJONEGORO',
        ]);
        Calon::create([
            'id' => 2,
            'no_online' => '082.00002/TA',
            'nama' => 'Calon Bojonegoro',
            'tgl_lahir' => '2005-01-01',
            'tem_lahir' => 'Bojonegoro',
        ]);
    }

    public function test_candidate_can_view_surat_pendaftaran_print_page(): void
    {
        $pokok = Pokok::find(1);
        $this->be($pokok, 'calon');

        $response = $this->get(route('calon.pdf'));
        $response->assertOk();

        // Header
        $response->assertSee('TENTARA NASIONAL INDONESIA');
        $response->assertSee('MARKAS BESAR ANGKATAN DARAT');
        $response->assertSee('SURAT PENDAFTARAN');
        $response->assertSee('Nomor : 082.00001/TA');

        // Form Fields matching user's PDF
        $response->assertSee('Nama Calon');
        $response->assertSee('Rendi Ariel Firdhaus');
        $response->assertSee('Tempat, Tanggal Lahir');
        $response->assertSee('Mojokerto, 28/10/2005');
        $response->assertSee('Jenis Kelamin');
        $response->assertSee('Pria/Wanita * )');
        $response->assertSee('Status');
        $response->assertSee('Nikah/belum pernah Nikah * )');
        $response->assertSee('Suku');
        $response->assertSee('Jawa');
        $response->assertSee('Agama');
        $response->assertSee('Islam');
        $response->assertSee('Tinggi & Berat Badan', false);
        $response->assertSee('166 Cm');
        $response->assertSee('70 Kg');
        $response->assertSee('Pendidikan Tertinggi');
        $response->assertSee('Dik Umum');
        $response->assertSee('SMK');
        $response->assertSee('Jurusan');
        $response->assertSee('Teknik Elektro Industri');
        $response->assertSee('Tahun Lulus');
        $response->assertSee('2023');
        $response->assertSee('Nilai Akhir (NA) / Rata-rata NA');
        $response->assertSee('81.99');
        $response->assertSee('Pekerjaan');
        $response->assertSee('Alamat (Kode Pos)');
        $response->assertSee('Ds Mojorejo Kec Jetis Kab/kota Mojokerto');
        $response->assertSee('Orang Tua/Wali *)');
        $response->assertSee('Karjono');
        $response->assertSee('Dsn.pantesrejo Ds.mojorejo Rt.01 Rw.04 Kec.jetis Kab.mojokerto');
        $response->assertSee('Pernah mendaftar yang ke');
        $response->assertSee('Tahun &nbsp;&nbsp;&nbsp;&nbsp;.... &nbsp;&nbsp;&nbsp;&nbsp;sampai tingkat &nbsp;&nbsp;&nbsp;&nbsp;....', false);

        // Photo box & Signatures
        $response->assertSee('Foto Calon');
        $response->assertSee('4 X 6');
        $response->assertSee('Tanda Tangan Calon,');
        $response->assertSee('a.n Ketua Panitia');
        $response->assertSee('Petugas Pendaftaran,');
        $response->assertSee('Eko Rudy Ardianto');
        $response->assertSee('Sertu NRP 31081739430988');

        // Footnotes
        $response->assertSee('Tulis dengan huruf cetak');
        $response->assertSee('*) Coret yang tidak perlu');
    }

    public function test_admin_can_review_own_calon_form(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'kodim' => 'KODIM 0814/JOMBANG']);
        $this->actingAs($admin);
        $this->get(route('calon.verify.show', 1))->assertOk()->assertSee('Validasi dan cetak PDF');
        $this->get(route('calon.verify.show', 2))->assertForbidden();
    }

    public function test_admin_can_print_calon_matching_own_kodim(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'kodim' => 'KODIM 0814/JOMBANG',
            'name' => 'Kapten Budi Santoso',
            'nrp' => '21980123450987',
        ]);
        $this->actingAs($admin);

        // Calon ID 1 is in KODIM 0814/JOMBANG
        $response = $this->get(route('calon.print', 1));
        $response->assertOk();
        $response->assertSee('SURAT PENDAFTARAN');
        $response->assertSee('Rendi Ariel Firdhaus');

        // Calon ID 2 is in KODIM 0813/BOJONEGORO -> Forbidden for Jombang admin
        $this->get(route('calon.print', 2))->assertForbidden();
    }

    public function test_superadmin_can_print_any_calon(): void
    {
        $superadmin = User::factory()->create(['role' => 'superadmin']);
        $this->actingAs($superadmin);

        $this->get(route('calon.print', 1))->assertOk()->assertSee('Rendi Ariel Firdhaus');
        $this->get(route('calon.print', 2))->assertOk()->assertSee('Calon Bojonegoro');
    }
}
