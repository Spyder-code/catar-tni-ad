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
            'tertua' => '2000-01-01',
            'termuda' => '2012-01-01',
            'lp_heading' => 'Coba',
            'lp_title_santri' => 'Coba',
            'lp_title_reguler' => 'Coba',
            'lihat_umur' => false,
            'label_ponpes' => 'Coba',
            'label_alamat_ponpes' => 'Coba',
            'label_kabupaten_ponpes' => 'Coba',
        ]);

        Setting::create([
            'pendaftaran' => 'CABA TA 2021',
            'heading_1' => 'Coba',
            'heading_2' => 'Coba',
            'content' => 'Coba',
            'dik' => '2021-07-01',
            'tertua' => '2000-01-01',
            'termuda' => '2012-01-01',
            'lp_heading' => 'Coba',
            'lp_title_santri' => 'Coba',
            'lp_title_reguler' => 'Coba',
            'lihat_umur' => false,
            'label_ponpes' => 'Coba',
            'label_alamat_ponpes' => 'Coba',
            'label_kabupaten_ponpes' => 'Coba',
        ]);
    }
}
