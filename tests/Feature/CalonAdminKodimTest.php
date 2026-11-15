<?php

namespace Tests\Feature;

use App\Models\Calon;
use App\Models\Pokok;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class CalonAdminKodimTest extends TestCase
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

        // Create Pokok and matching Calon records
        $pokok1 = Pokok::create([
            'id' => 1,
            'no_animo' => 'ANIMO-0814',
            'no_online' => 'ONLINE-0814',
            'nama' => 'Calon Jombang',
            'kodim' => 'KODIM 0814/JOMBANG',
        ]);
        Calon::create([
            'id' => 1,
            'no_online' => 'ONLINE-0814',
            'nama' => 'Calon Jombang',
            'tgl_lahir' => '2005-01-01',
            'tem_lahir' => 'Jombang',
        ]);

        $pokok2 = Pokok::create([
            'id' => 2,
            'no_animo' => 'ANIMO-0813',
            'no_online' => 'ONLINE-0813',
            'nama' => 'Calon Bojonegoro',
            'kodim' => 'KODIM 0813/BOJONEGORO',
        ]);
        Calon::create([
            'id' => 2,
            'no_online' => 'ONLINE-0813',
            'nama' => 'Calon Bojonegoro',
            'tgl_lahir' => '2005-02-02',
            'tem_lahir' => 'Bojonegoro',
        ]);
    }

    public function test_admin_only_sees_calon_matching_their_kodim_and_sees_no_animo(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'kodim' => 'KODIM 0814/JOMBANG',
        ]);
        $this->actingAs($admin);

        $response = $this->get(route('calon'));
        $response->assertOk();

        // Admin sees own kodim's calon, but not other kodim's calon
        $response->assertSee('Calon Jombang');
        $response->assertDontSee('Calon Bojonegoro');

        // Column has "No animo" and animo value, no "No online"
        $response->assertSee('No animo');
        $response->assertSee('ANIMO-0814');
        $response->assertDontSee('ANIMO-0813');
        $response->assertDontSee('No online');

        // Table style uses pokok table shell and table classes
        $response->assertSee('pokok-table-shell', false);
        $response->assertSee('pokok-table', false);

        // CSV export buttons are completely removed; Excel export is present
        $response->assertDontSee('CSV');
        $response->assertSee('Export Excel');
        $response->assertSee('Export Terpilih (Excel)');

        // Admin cannot see "Hapus Semua"
        $response->assertDontSee('Hapus Semua');
    }

    public function test_superadmin_sees_all_calon_and_delete_all_button(): void
    {
        $superadmin = User::factory()->create([
            'role' => 'superadmin',
        ]);
        $this->actingAs($superadmin);

        $response = $this->get(route('calon'));
        $response->assertOk();

        $response->assertSee('Calon Jombang');
        $response->assertSee('Calon Bojonegoro');
        $response->assertSee('ANIMO-0814');
        $response->assertSee('ANIMO-0813');
        $response->assertSee('Hapus Semua');
    }

    public function test_admin_cannot_delete_calon_from_another_kodim(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'kodim' => 'KODIM 0814/JOMBANG',
        ]);
        $this->actingAs($admin);

        // Calon ID 2 belongs to Bojonegoro
        $this->delete(route('calon.destroy'), ['id' => 2])
            ->assertForbidden();

        $this->assertDatabaseHas('calon', ['id' => 2]);

        // Calon ID 1 belongs to Jombang (admin's kodim)
        $this->delete(route('calon.destroy'), ['id' => 1])
            ->assertRedirect();

        $this->assertDatabaseMissing('calon', ['id' => 1]);
    }

    public function test_admin_export_only_includes_own_kodim(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'kodim' => 'KODIM 0814/JOMBANG',
        ]);
        $this->actingAs($admin);

        Excel::fake();

        $this->post(route('calon.data.exportAll'));

        Excel::assertDownloaded('calon.xlsx', function (\App\Exports\DataExport $export) {
            $view = $export->view();
            $data = $view->getData()['data'];
            $names = $data->pluck('nama')->all();
            return $names === ['Calon Jombang'];
        });

        // Even if admin attempts to pass ID 2 (Bojonegoro) to export selected:
        $this->post(route('calon.data.export'), ['calon' => [1, 2]]);

        Excel::assertDownloaded('calon.xlsx', function (\App\Exports\DataExport $export) {
            $view = $export->view();
            $data = $view->getData()['data'];
            $names = $data->pluck('nama')->all();
            return $names === ['Calon Jombang'];
        });
    }

    public function test_admin_cannot_delete_all_calon(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'kodim' => 'KODIM 0814/JOMBANG',
        ]);
        $this->actingAs($admin);

        $this->post(route('calon.deleteAll'))->assertForbidden();
        $this->assertDatabaseHas('calon', ['id' => 1]);
        $this->assertDatabaseHas('calon', ['id' => 2]);
    }

    public function test_calon_can_be_sorted_and_entries_per_page_can_be_changed(): void
    {
        $superadmin = User::factory()->create(['role' => 'superadmin']);
        $this->actingAs($superadmin);

        // Sort by nama asc
        $responseAsc = $this->get(route('calon', ['sort' => 'nama', 'direction' => 'asc']));
        $responseAsc->assertOk();
        $this->assertSame('Calon Bojonegoro', $responseAsc->viewData('data')->first()->nama);

        // Sort by nama desc
        $responseDesc = $this->get(route('calon', ['sort' => 'nama', 'direction' => 'desc']));
        $responseDesc->assertOk();
        $this->assertSame('Calon Jombang', $responseDesc->viewData('data')->first()->nama);

        // Sort by no_animo asc
        $responseAnimo = $this->get(route('calon', ['sort' => 'no_animo', 'direction' => 'asc']));
        $responseAnimo->assertOk();
        $this->assertSame('ANIMO-0813', $responseAnimo->viewData('data')->first()->no_animo);

        // Test per_page selector
        $responsePerPage = $this->get(route('calon', ['per_page' => 10]));
        $responsePerPage->assertOk();
        $this->assertSame(10, $responsePerPage->viewData('data')->perPage());
        $responsePerPage->assertSee('calon-per-page', false);
    }

    public function test_pokok_can_be_sorted_and_entries_per_page_can_be_changed(): void
    {
        $superadmin = User::factory()->create(['role' => 'superadmin']);
        $this->actingAs($superadmin);

        // Sort by nama asc
        $responseAsc = $this->get(route('pokok', ['sort' => 'nama', 'direction' => 'asc']));
        $responseAsc->assertOk();
        $this->assertSame('Calon Bojonegoro', $responseAsc->viewData('data')->first()->nama);

        // Sort by nama desc
        $responseDesc = $this->get(route('pokok', ['sort' => 'nama', 'direction' => 'desc']));
        $responseDesc->assertOk();
        $this->assertSame('Calon Jombang', $responseDesc->viewData('data')->first()->nama);

        // Per page selector
        $responsePerPage = $this->get(route('pokok', ['per_page' => 25]));
        $responsePerPage->assertOk();
        $this->assertSame(25, $responsePerPage->viewData('data')->perPage());
        $responsePerPage->assertSee('filter-per-page', false);
    }
}
