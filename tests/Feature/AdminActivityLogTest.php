<?php

namespace Tests\Feature;

use App\Models\AdminActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AdminActivityLogTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite.database', ':memory:');
        DB::purge('sqlite');

        require_once database_path('migrations/2014_10_12_000000_create_users_table.php');
        (new \CreateUsersTable)->up();
        (require database_path('migrations/2026_11_14_000001_add_admin_roles_to_users.php'))->up();
        (require database_path('migrations/2026_11_14_000002_add_nrp_to_users.php'))->up();
        (require database_path('migrations/2026_11_15_000001_create_admin_activity_logs_table.php'))->up();
    }

    public function test_admin_activity_is_recorded_and_only_superadmin_can_view_history(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'username' => 'localadmin', 'email' => 'local@example.test']);
        $superadmin = User::factory()->create(['role' => 'superadmin', 'username' => 'rootadmin', 'email' => 'root@example.test']);

        $this->actingAs($admin);
        $this->get(route('admin-activity.index'))->assertForbidden();
        $this->put(route('profile.update', $admin->id), [
            'name' => 'Updated Admin', 'username' => $admin->username,
            'password' => 'must-not-be-logged',
        ])->assertRedirect();

        $this->assertDatabaseHas('admin_activity_logs', [
            'user_id' => $admin->id, 'route_name' => 'profile.update',
            'method' => 'PUT', 'action' => 'update', 'status_code' => 302,
        ]);
        $this->assertDatabaseHas('admin_activity_logs', [
            'user_id' => $admin->id, 'route_name' => 'admin-activity.index', 'status_code' => 403,
        ]);
        $this->assertStringNotContainsString('must-not-be-logged', json_encode(AdminActivityLog::get()->toArray()));

        $this->actingAs($superadmin);
        $this->get(route('admin-activity.index'))->assertOk()->assertSee('Updated Admin');
        $this->get(route('admin-activity.index', ['role' => 'admin']))->assertOk();
        $this->assertDatabaseHas('admin_activity_logs', [
            'user_id' => $superadmin->id, 'route_name' => 'admin-activity.index', 'action' => 'view',
        ]);
    }

    public function test_login_and_logout_are_recorded(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin', 'username' => 'auditadmin',
            'password' => bcrypt('password123'),
        ]);

        $this->post(route('login'), ['username' => 'auditadmin', 'password' => 'password123'])
            ->assertRedirect(route('home'));
        $this->post(route('logout'))->assertRedirect();

        $this->assertDatabaseHas('admin_activity_logs', ['user_id' => $admin->id, 'action' => 'login']);
        $this->assertDatabaseHas('admin_activity_logs', ['user_id' => $admin->id, 'action' => 'logout']);
    }
}
