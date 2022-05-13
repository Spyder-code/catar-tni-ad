<?php

namespace Database\Seeders;

use App\Models\LandingPage;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LandingPage::create([
            'pendaftaran' => 'CABA TA 2021',
            'heading_1' => 'Coba',
            'heading_2' => 'Coba',
            'content' => 'Coba',
            'dik' => '2021-07-01',
        ]);
    }
}
