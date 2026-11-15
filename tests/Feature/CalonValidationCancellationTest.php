<?php

namespace Tests\Feature;

use App\Http\Requests\CalonRequest;
use App\Models\Calon;
use App\Models\Pokok;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CalonValidationCancellationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite.database', ':memory:');
        DB::purge('sqlite');
        require_once database_path('migrations/2014_10_12_000000_create_users_table.php');
        require_once database_path('migrations/2020_06_10_171053_create_pokoks_table.php');
        require_once database_path('migrations/2021_06_04_145948_create_calons_table.php');
        require_once database_path('migrations/2021_06_04_150418_create_pendidikans_table.php');
        require_once database_path('migrations/2021_06_04_150646_create_walis_table.php');
        require_once database_path('migrations/2021_06_10_173837_create_t2020_s_table.php');
        require_once database_path('migrations/2021_06_15_125307_create_t2019_s_table.php');
        (new \CreateUsersTable)->up();
        (new \CreatePokoksTable)->up();
        (require database_path('migrations/2026_11_14_000001_add_admin_roles_to_users.php'))->up();
        (new \CreateCalonsTable)->up();
        (new \CreatePendidikansTable)->up();
        (new \CreateWalisTable)->up();
        require_once database_path('migrations/update/2022_07_01_045919_update_wali_table.php');
        (new \UpdateWaliTable)->up();
        (new \CreateT2020STable)->up();
        (new \CreateT2019STable)->up();
        (require database_path('migrations/2026_11_15_000000_create_validation_counters.php'))->up();
        (require database_path('migrations/2026_11_15_000002_make_calon_validation_number_nullable.php'))->up();

        foreach ([1 => '082.00001/BA', 2 => null, 3 => '082.00003/BA'] as $id => $number) {
            Pokok::create(['id' => $id, 'no_animo' => 'BA-' . $id, 'no_online' => $number, 'kodim' => 'KODIM A']);
            Calon::create(['id' => $id, 'no_online' => $number, 'nama' => 'Calon ' . $id]);
        }
        $this->actingAs(User::factory()->create(['role' => 'admin', 'kodim' => 'KODIM A']));
    }

    public function test_cancellation_requires_consent_and_smallest_empty_number_is_reused(): void
    {
        $this->post(route('calon.verify.cancel', 1))->assertSessionHasErrors('persetujuan');
        $this->assertSame('082.00001/BA', Calon::find(1)->no_online);

        $this->post(route('calon.verify.cancel', 1), ['persetujuan' => '1'])->assertRedirect(route('calon'));
        $this->assertNull(Calon::find(1)->no_online);
        $this->assertNull(Pokok::find(1)->no_online);
        $this->assertNull(Pokok::find(1)->tanggal_validasi);

        $payload = ['pokok_id' => 2, 'calon' => [], 'pendidikan' => [], 'wali' => []];
        foreach ((new CalonRequest)->rules() as $field => $rule) {
            if (str_contains($rule, 'required')) {
                data_set($payload, $field, '-');
            }
        }
        $payload['calon']['ktp'] = '1234567890123456';
        $payload['calon']['tgl_lahir'] = '2005-01-01';
        $this->post(route('calon.verify.submit', 2), $payload)->assertSessionHasNoErrors()->assertRedirect(route('calon.print', 2));
        $this->assertSame('082.00001/BA', Calon::find(2)->no_online);
        $this->assertSame('082.00001/BA', Pokok::find(2)->no_online);
        $this->assertSame('082.00003/BA', Calon::find(3)->no_online);
    }
}
