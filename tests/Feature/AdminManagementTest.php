<?php

namespace Tests\Feature;

use App\Models\Pokok;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AdminManagementTest extends TestCase
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
        require_once database_path('migrations/2021_06_27_170009_create_settings_table.php');
        (new \CreateSettingsTable)->up();
        require_once database_path('migrations/2021_06_05_022920_create_visitors_table.php');
        (new \CreateVisitorsTable)->up();
        DB::table('settings')->insert(['id' => 1]);

        Pokok::create(['nama' => 'Satu', 'kodim' => 'KODIM 0814']);
        Pokok::create(['nama' => 'Dua', 'kodim' => 'KODIM 0815']);
    }

    public function test_admin_can_only_read_own_kodim_and_cannot_change_or_export_pokok(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'kodim' => 'KODIM 0814']);
        $this->actingAs($admin);

        $response = $this->get(route('pokok'));
        $response->assertOk()->assertDontSee('Import Excel')->assertDontSee('Export Excel')->assertDontSee('Tambah Data');
        $this->assertSame(1, $response->viewData('data')->total());
        $this->assertSame('KODIM 0814', $response->viewData('data')->first()->kodim);
        $this->assertSame(['KODIM 0814'], $response->viewData('options')['kodim']->all());

        $this->get(route('pokok.export'))->assertForbidden();
        $this->get(route('pokok.create'))->assertForbidden();
        $this->post(route('pokok.import'))->assertForbidden();
        $this->post(route('pokok.store', ['nama' => 'Baru']))->assertForbidden();
        $this->delete(route('pokok.delete', Pokok::first()))->assertForbidden();
        $this->post(route('pokok.destroy'))->assertForbidden();
        $this->get(route('admin-management.index'))->assertForbidden();
        $this->get(route('landing-page.edit', 1))->assertForbidden();
    }

    public function test_superadmin_can_manage_multiple_admins_and_replace_kodim_signer(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'superadmin']));
        $this->get(route('admin-management.index'))->assertOk()->assertSee('KODIM 0814');

        $first = $this->adminData('first', '1');
        $this->post(route('admin-management.store'), $first)->assertRedirect(route('admin-management.index'));
        $this->assertTrue(User::where('username', 'first')->first()->isPenanggungJawab());
        $this->assertSame('12345678', User::where('username', 'first')->first()->nrp);

        $second = $this->adminData('second', '1');
        $this->post(route('admin-management.store'), $second)->assertRedirect(route('admin-management.index'));
        $this->assertSame(2, User::where('role', 'admin')->where('kodim', 'KODIM 0814')->count());
        $this->assertFalse(User::where('username', 'first')->first()->isPenanggungJawab());
        $this->assertTrue(User::where('username', 'second')->first()->isPenanggungJawab());

        $this->post(route('admin-management.store'), $this->adminData('third', '0', 'UNKNOWN'))
            ->assertSessionHasErrors('kodim');
        $this->assertSame(2, User::where('role', 'admin')->count());
    }

    public function test_nrp_is_required_only_for_penanggung_jawab_on_create_and_update(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'superadmin']));

        $this->post(route('admin-management.store'), $this->adminData('signer', '1'))
            ->assertRedirect(route('admin-management.index'));
        $missingNrp = $this->adminData('missing', '1');
        unset($missingNrp['nrp']);
        $this->post(route('admin-management.store'), $missingNrp)->assertSessionHasErrors('nrp');

        $optionalNrp = $this->adminData('optional', '0');
        unset($optionalNrp['nrp']);
        $this->post(route('admin-management.store'), $optionalNrp)
            ->assertRedirect(route('admin-management.index'));
        $admin = User::where('username', 'optional')->firstOrFail();
        $this->assertNull($admin->nrp);

        $update = $this->adminData('optional', '1');
        unset($update['nrp']);
        $this->put(route('admin-management.update', $admin), $update)->assertSessionHasErrors('nrp');
        $this->assertFalse($admin->fresh()->isPenanggungJawab());

        $update['nrp'] = '00987654';
        $this->put(route('admin-management.update', $admin), $update)
            ->assertRedirect(route('admin-management.index'));
        $this->assertTrue($admin->fresh()->isPenanggungJawab());
        $this->assertSame('00987654', $admin->fresh()->nrp);
    }

    public function test_admin_cannot_change_another_users_profile_or_role(): void
    {
        $superadmin = User::factory()->create(['role' => 'superadmin']);
        $admin = User::factory()->create([
            'role' => 'admin', 'kodim' => 'KODIM 0814',
            'username' => 'localadmin', 'email' => 'local@example.test',
        ]);
        $this->actingAs($admin);
        $this->put(route('profile.update', $superadmin->id), [
            'name' => 'Changed', 'username' => 'changed', 'role' => 'superadmin',
        ])->assertForbidden();
        $this->put(route('profile.update', $admin->id), [
            'name' => 'Updated', 'username' => 'localadmin', 'role' => 'superadmin',
        ])->assertRedirect();
        $this->assertSame('admin', $admin->fresh()->role);
        $this->assertSame('Updated', $admin->fresh()->name);
    }

    public function test_admin_sidebar_menu_only_shows_profile_pokok_calon_and_logout(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'kodim' => 'KODIM 0814']);
        $this->actingAs($admin);

        $response = $this->get(route('pokok'));
        $response->assertOk();

        // Allowed menus
        $response->assertSee('<span class="hide-menu">Profile</span>', false);
        $response->assertSee('<span class="hide-menu">Data pokok</span>', false);
        $response->assertSee('<span class="hide-menu">Data calon</span>', false);
        $response->assertSee('Logout');

        // Forbidden menus for admin
        $response->assertDontSee('<span class="hide-menu">Dashboard</span>', false);
        $response->assertDontSee('<span class="hide-menu">Riwayat Aktivitas</span>', false);
        $response->assertDontSee('<span class="hide-menu">Manajemen Admin</span>', false);
        $response->assertDontSee('<span class="hide-menu">Setting</span>', false);

        // Accessing /main redirects admin to pokok
        $this->get(route('home'))->assertRedirect(route('pokok'));
    }

    public function test_superadmin_sidebar_menu_shows_dashboard_and_all_menus(): void
    {
        $superadmin = User::factory()->create(['role' => 'superadmin']);
        $this->actingAs($superadmin);

        $response = $this->get(route('home'));
        $response->assertOk();

        $response->assertSee('<span class="hide-menu">Dashboard</span>', false);
        $response->assertSee('<span class="hide-menu">Profile</span>', false);
        $response->assertSee('<span class="hide-menu">Data pokok</span>', false);
        $response->assertSee('<span class="hide-menu">Data calon</span>', false);
        $response->assertSee('<span class="hide-menu">Riwayat Aktivitas</span>', false);
        $response->assertSee('<span class="hide-menu">Manajemen Admin</span>', false);
        $response->assertSee('<span class="hide-menu">Setting</span>', false);
        $response->assertSee('Logout');
    }

    private function adminData(string $username, string $signer, string $kodim = 'KODIM 0814'): array
    {
        return [
            'name' => ucfirst($username), 'username' => $username,
            'email' => $username . '@example.test', 'kodim' => $kodim,
            'password' => 'password123', 'password_confirmation' => 'password123',
            'penanggung_jawab' => $signer,
            'nrp' => '12345678',
        ];
    }
}
