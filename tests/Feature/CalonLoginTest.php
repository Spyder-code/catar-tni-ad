<?php

namespace Tests\Feature;

use App\Models\Pokok;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CalonLoginTest extends TestCase
{
    public function test_login_uses_no_animo_then_matches_it_with_date_of_birth(): void
    {
        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite.database', ':memory:');
        DB::purge('sqlite');

        require_once database_path('migrations/2020_06_10_171053_create_pokoks_table.php');
        require_once database_path('migrations/2021_06_27_170009_create_settings_table.php');
        (new \CreatePokoksTable)->up();
        (new \CreateSettingsTable)->up();

        Pokok::create([
            'no_animo' => 'BA/00001/MOJOKERTO',
            'nama' => 'Calon Uji',
            'tgl_lahir' => '13-08-2007',
        ]);

        $lookup = $this->post(route('login.takeUser'), ['no_animo' => 'BA/00001/MOJOKERTO']);
        $lookup->assertOk();
        $lookup->assertSee('BA/00001/MOJOKERTO');
        $lookup->assertSee('name="no_animo"', false);

        $this->post(route('login.takeUser'), ['no_online' => '082.00006/BA'])
            ->assertSessionHasErrors('no_animo');

        $this->post(route('login.calon'), [
            'no_animo' => 'BA/00001/MOJOKERTO',
            'tgl_lahir' => '2007-08-14',
        ])->assertRedirect(route('login'));
        $this->assertFalse(Auth::guard('calon')->check());

        $this->post(route('login.calon'), [
            'no_animo' => 'BA/00001/MOJOKERTO',
            'tgl_lahir' => '2007-08-13',
        ])->assertRedirect(route('calon.form'));
        $this->assertTrue(Auth::guard('calon')->check());
        $this->assertSame('BA/00001/MOJOKERTO', Auth::guard('calon')->user()->no_animo);
    }
}
