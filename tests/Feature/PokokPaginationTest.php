<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PokokPaginationTest extends TestCase
{
    public function test_pagination_keeps_fifty_rows_per_page_and_preserves_filters_over_one_thousand_records(): void
    {
        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite.database', ':memory:');
        DB::purge('sqlite');

        require_once database_path('migrations/2014_10_12_000000_create_users_table.php');
        require_once database_path('migrations/2020_06_10_171053_create_pokoks_table.php');
        (new \CreateUsersTable)->up();
        (new \CreatePokoksTable)->up();
        (require database_path('migrations/2026_11_14_000001_add_admin_roles_to_users.php'))->up();
        $this->actingAs(User::factory()->create(['role' => 'superadmin']));

        for ($start = 1; $start <= 1105; $start += 250) {
            $rows = [];
            for ($i = $start; $i < min($start + 250, 1106); $i++) {
                $rows[] = [
                    'no_animo' => 'BA/' . str_pad((string) $i, 5, '0', STR_PAD_LEFT),
                    'nama' => 'Calon ' . $i,
                    'jalur_pendaftaran' => 'Mandiri',
                ];
            }
            DB::table('pokok')->insert($rows);
        }
        DB::table('pokok')->insert([
            'no_animo' => 'TA/00001', 'nama' => 'CATA', 'jalur_pendaftaran' => 'Lain',
        ]);

        $query = ['q' => 'Calon', 'jenis' => 'CABA', 'jalur_pendaftaran' => 'Mandiri'];
        $first = $this->get(route('pokok', $query));
        $first->assertOk();
        $page = $first->viewData('data');
        $this->assertSame(50, $page->count());
        $this->assertSame(1105, $page->total());
        $this->assertSame(23, $page->lastPage());
        $this->assertSame('BA/01105', $page->first()->no_animo);
        $this->assertStringContainsString('jenis=CABA', $page->url(2));
        $this->assertStringContainsString('q=Calon', $page->url(2));
        $this->assertStringContainsString('jalur_pendaftaran=Mandiri', $page->url(2));

        $second = $this->get(route('pokok', $query + ['page' => 2]));
        $second->assertOk();
        $this->assertSame(50, $second->viewData('data')->count());
        $this->assertSame('BA/01055', $second->viewData('data')->first()->no_animo);

        $last = $this->get(route('pokok', $query + ['page' => 23]));
        $last->assertOk();
        $this->assertSame(5, $last->viewData('data')->count());
        $this->assertSame('BA/00005', $last->viewData('data')->first()->no_animo);
    }
}
