<?php

namespace Database\Seeders;

use App\Models\Calon;
use App\Models\Pendidikan;
use App\Models\Pokok;
use App\Models\T2020;
use App\Models\Wali;
use Carbon\Carbon;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class CalonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create('id_ID');

        $kodims = [
            'KODIM 0814/JOMBANG' => ['city' => 'Jombang', 'panda' => 'MOJOKERTO'],
            'KODIM 0813/BOJONEGORO' => ['city' => 'Bojonegoro', 'panda' => 'MOJOKERTO'],
            'KODIM 0812/LAMONGAN' => ['city' => 'Lamongan', 'panda' => 'MOJOKERTO'],
            'KODIM 0809/KEDIRI' => ['city' => 'Kediri', 'panda' => 'MOJOKERTO'],
            'KODIM 0815/MOJOKERTO' => ['city' => 'Mojokerto', 'panda' => 'MOJOKERTO'],
        ];

        // 1. Sinkronkan data Calon untuk Pokok yang sudah ada tapi belum memiliki data Calon
        $existingPokoks = Pokok::whereDoesntHave('calon')->get();
        foreach ($existingPokoks as $pokok) {
            $this->createCalonForPokok($pokok, $faker);
        }

        // 2. Tambahkan calon baru agar total data memadai untuk pagination dan filtering
        $totalTarget = 30;
        $currentCount = Calon::count();
        $needed = max(0, $totalTarget - $currentCount);

        $kodimKeys = array_keys($kodims);

        for ($i = 0; $i < $needed; $i++) {
            $kodimKey = $kodimKeys[$i % count($kodimKeys)];
            $kodimInfo = $kodims[$kodimKey];
            $city = $kodimInfo['city'];
            $panda = $kodimInfo['panda'];

            $birthDate = $faker->dateTimeBetween('-21 years', '-17 years');
            $carbonBirth = Carbon::instance($birthDate);

            $animoNum = Pokok::max('id') + 1;
            $isCaba = $faker->boolean(70);
            $prefixAnimo = $isCaba ? 'BA' : 'TA';
            $noAnimo = sprintf('%s/%05d/%s', $prefixAnimo, $animoNum, strtoupper($panda));
            $noOnline = sprintf('082.%05d/%s', $animoNum, $prefixAnimo);

            $nama = strtoupper($faker->name('male'));
            $nik = '35' . $faker->numerify('##############');
            $agama = $faker->randomElement(['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha']);
            $suku = $faker->randomElement(['Jawa', 'Madura', 'Sunda']);
            $phone = '08' . $faker->numerify('##########');
            $schoolName = sprintf('SMAN 1 %s', $city);

            $pokok = Pokok::create([
                'no_animo' => $noAnimo,
                'no_online' => $noOnline,
                'nama' => $nama,
                'nik' => $nik,
                'tem_lahir' => $city,
                'tgl_lahir' => $carbonBirth->format('d-m-Y'),
                'agama' => $agama,
                'suku' => $suku,
                'alamat_c' => $faker->streetAddress . ', ' . $city,
                'tb' => (string) $faker->numberBetween(165, 185),
                'bb' => (string) $faker->numberBetween(55, 78),
                'ortu1' => strtoupper($faker->name('male')),
                'kerja' => $faker->randomElement(['PNS', 'Wiraswasta', 'Petani', 'TNI-AD', 'Karyawan Swasta', 'Guru']),
                'no_hp_ortu' => '08' . $faker->numerify('##########'),
                'jenis_sekolah' => 'SMA',
                'nama_sekolah' => $schoolName,
                'jur' => $faker->randomElement(['IPA', 'IPS', 'Teknik']),
                'th_lulus' => (string) $faker->numberBetween(2022, 2024),
                'no_telp_wa' => $phone,
                'email' => $faker->unique()->safeEmail,
                'jenis_pendaftaran' => $isCaba ? 'CABA PK PRIA' : 'CATA PK PRIA',
                'jalur_pendaftaran' => $faker->randomElement(['REGULER', 'KEAHLIAN', 'SANTRI']),
                'kdpanda' => $panda,
                'kodam' => 'KODAM V/BRAWIJAYA',
                'kodim' => $kodimKey,
                'koramil' => sprintf('KORAMIL %02d', $faker->numberBetween(1, 15)),
                'babinsa' => 'SERDA ' . strtoupper($faker->lastName),
                'status' => 'VALID',
                'tanggal_validasi' => Carbon::now()->subDays($faker->numberBetween(1, 60))->format('d-m-Y'),
                'wali1' => strtoupper($faker->name('male')),
                'alamat_o' => $faker->streetAddress . ', ' . $city,
            ]);

            $this->createCalonForPokok($pokok, $faker, $carbonBirth);
        }
    }

    /**
     * Buat data Calon beserta Pendidikan, Wali, dan Nilai T2020 untuk Pokok yang bersangkutan.
     */
    private function createCalonForPokok(Pokok $pokok, $faker, ?Carbon $carbonBirth = null): void
    {
        if (!$carbonBirth) {
            $tgl = $pokok->tgl_lahir;
            if ($tgl && strtotime($tgl)) {
                $carbonBirth = Carbon::parse($tgl);
            } else {
                $carbonBirth = Carbon::now()->subYears(18);
            }
        }

        $now = Carbon::now();
        $diff = $carbonBirth->diff($now);
        $kabupaten = $pokok->tem_lahir ?: 'Jombang';

        $calon = Calon::create([
            'id' => $pokok->id,
            'no_online' => $pokok->no_online ?: ('082.' . str_pad((string) $pokok->id, 5, '0', STR_PAD_LEFT) . '/BA'),
            'ktp' => $pokok->nik ?: ('35' . $faker->numerify('##############')),
            'no_kk' => '35' . $faker->numerify('##############'),
            'nama' => $pokok->nama,
            'agama' => $pokok->agama ?: 'Islam',
            'tem_lahir' => $kabupaten,
            'tgl_lahir' => $carbonBirth->format('Y-m-d'),
            'l_hri' => $carbonBirth->format('d'),
            'l_bln' => $carbonBirth->format('m'),
            'l_thn' => $carbonBirth->format('Y'),
            'u_hri' => (string) $diff->d,
            'u_bln' => (string) $diff->m,
            'u_thn' => (string) $diff->y,
            'umr' => sprintf('%d Thn %d Bln %d Hr', $diff->y, $diff->m, $diff->d),
            'ket_umr' => $diff->y >= 18 ? 'Memenuhi Syarat' : 'Belum Cukup Umur',
            'dik' => Carbon::now()->addMonths(2)->format('Y-m-d'),
            'suku' => $pokok->suku ?: 'Jawa',
            'alamat' => $pokok->alamat_c ?: ($faker->streetAddress . ', ' . $kabupaten),
            'rt' => sprintf('%02d', $faker->numberBetween(1, 15)),
            'rw' => sprintf('%02d', $faker->numberBetween(1, 10)),
            'no' => (string) $faker->numberBetween(1, 99),
            'dsn' => 'Dsn. ' . $faker->streetName,
            'ds' => 'Desa ' . $faker->streetName,
            'kec' => 'Kec. ' . $kabupaten,
            'kab' => 'Kab. ' . $kabupaten,
            'telp' => $pokok->no_telp_wa ?: ('08' . $faker->numerify('##########')),
            'daftar_ke' => '1',
            'aspek_tl' => '-',
            'prestasi_provinsi' => $faker->optional(0.25)->sentence(3),
            'prestasi_nasional' => $faker->optional(0.1)->sentence(3),
            'tb' => $pokok->tb ?: (string) $faker->numberBetween(165, 185),
            'bb' => $pokok->bb ?: (string) $faker->numberBetween(55, 78),
            'tindik' => 'Tidak',
            'tatto' => 'Tidak',
            'keahlian' => $faker->randomElement(['Komputer', 'Otomotif', 'Bahasa Inggris', 'Renang', 'Bela Diri', 'Musik']),
            'motifasi' => 'Mengabdi kepada Negara Kesatuan Republik Indonesia melalui TNI AD',
            'hobi' => $faker->randomElement(['Sepak Bola', 'Lari', 'Renang', 'Bulu Tangkis', 'Membaca']),
            'email' => $pokok->email ?: $faker->unique()->safeEmail,
            'pernah_kerja' => 'Belum',
            'bpjs' => '000' . $faker->numerify('########'),
            'inst' => '@' . strtolower(str_replace(' ', '', substr($pokok->nama, 0, 10))),
            'face' => strtolower(str_replace(' ', '', substr($pokok->nama, 0, 10))),
            'tiktok' => '@' . strtolower(str_replace(' ', '', substr($pokok->nama, 0, 10))),
            'twiter' => '@' . strtolower(str_replace(' ', '', substr($pokok->nama, 0, 10))),
        ]);

        // Buat data Pendidikan
        Pendidikan::firstOrCreate(['calon_id' => $calon->id], [
            'sd' => 'SDN 1 ' . $kabupaten,
            'smp' => 'SMPN 1 ' . $kabupaten,
            'sma' => $pokok->nama_sekolah ?: ('SMAN 1 ' . $kabupaten),
            'l_sd' => 2018,
            'l_smp' => 2021,
            'l_sma' => (int) ($pokok->th_lulus ?: 2024),
            'kab_sd' => $kabupaten,
            'kab_smp' => $kabupaten,
            'kab_sma' => $kabupaten,
            'nama_sma' => $pokok->nama_sekolah ?: ('SMAN 1 ' . $kabupaten),
            'jur' => $pokok->jur ?: 'IPA',
            'jumlah_nuan' => '425.50',
            'rata' => '85.10',
            'almt_sma' => 'Jl. Pahlawan No. 1, ' . $kabupaten,
            'nisnsd' => $faker->numerify('00########'),
            'nisnsmp' => $faker->numerify('00########'),
            'nisnsma' => $faker->numerify('00########'),
        ]);

        // Buat data Wali
        Wali::firstOrCreate(['calon_id' => $calon->id], [
            'ayah' => $pokok->ortu1 ?: strtoupper($faker->name('male')),
            'a_kerja' => $pokok->kerja ?: 'Wiraswasta',
            'ibu' => strtoupper($faker->name('female')),
            'i_kerja' => 'Ibu Rumah Tangga',
            'o_telp' => $pokok->no_hp_ortu ?: ('08' . $faker->numerify('##########')),
            'o_alamat' => $pokok->alamat_c ?: ($faker->streetAddress . ', ' . $kabupaten),
            'status_wali' => 1,
            'hub_calon_wali' => 'Kandung',
        ]);

        // Buat data T2020 (Nilai)
        $mtk = (string) $faker->numberBetween(78, 92);
        $ind = (string) $faker->numberBetween(80, 95);
        $ing = (string) $faker->numberBetween(75, 90);
        T2020::firstOrCreate(['calon_id' => $calon->id], [
            'bipeng1' => $ind, 'biket1' => $ind,
            'bigpeng1' => $ing, 'bigket1' => $ing,
            'mtkpeng1' => $mtk, 'mtkket1' => $mtk,
            'rata1' => '85.0',
            'rata2' => '86.0',
            'rata3' => '85.5',
            'rata4' => '87.0',
            'rata5' => '88.0',
            'rata6' => '88.5',
            'rata_akhir' => '86.6',
        ]);
    }
}
