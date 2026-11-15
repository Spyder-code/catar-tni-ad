<?php

namespace Database\Factories;

use App\Models\Calon;
use Carbon\Carbon;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Calon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = FakerFactory::create('id_ID');

        $birthDate = $faker->dateTimeBetween('-21 years', '-17 years');
        $carbonBirth = Carbon::instance($birthDate);
        $now = Carbon::now();
        $diff = $carbonBirth->diff($now);

        $kabupaten = $faker->randomElement(['Jombang', 'Bojonegoro', 'Lamongan', 'Kediri', 'Mojokerto', 'Tuban', 'Sidoarjo']);
        $agama = $faker->randomElement(['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha']);
        $suku = $faker->randomElement(['Jawa', 'Madura', 'Sunda']);

        return [
            'no_online' => '082.' . str_pad((string) $faker->numberBetween(1, 9999), 5, '0', STR_PAD_LEFT) . '/BA',
            'ktp' => '35' . $faker->numerify('##############'),
            'no_kk' => '35' . $faker->numerify('##############'),
            'nama' => strtoupper($faker->name('male')),
            'agama' => $agama,
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
            'suku' => $suku,
            'alamat' => $faker->streetAddress,
            'rt' => sprintf('%02d', $faker->numberBetween(1, 15)),
            'rw' => sprintf('%02d', $faker->numberBetween(1, 10)),
            'no' => (string) $faker->numberBetween(1, 99),
            'dsn' => 'Dsn. ' . $faker->streetName,
            'ds' => 'Desa ' . $faker->streetName,
            'kec' => 'Kec. ' . $kabupaten,
            'kab' => 'Kab. ' . $kabupaten,
            'telp' => '08' . $faker->numerify('##########'),
            'daftar_ke' => (string) $faker->numberBetween(1, 3),
            'aspek_tl' => '-',
            'prestasi_provinsi' => $faker->optional(0.3)->sentence(3),
            'prestasi_nasional' => $faker->optional(0.1)->sentence(3),
            'tb' => (string) $faker->numberBetween(165, 185),
            'bb' => (string) $faker->numberBetween(55, 78),
            'tindik' => 'Tidak',
            'tatto' => 'Tidak',
            'keahlian' => $faker->randomElement(['Komputer', 'Otomotif', 'Bahasa Inggris', 'Renang', 'Bela Diri', 'Musik']),
            'motifasi' => 'Mengabdi kepada Negara Kesatuan Republik Indonesia melalui TNI AD',
            'hobi' => $faker->randomElement(['Sepak Bola', 'Lari', 'Renang', 'Bulu Tangkis', 'Membaca']),
            'email' => $faker->unique()->safeEmail,
            'pernah_kerja' => 'Belum',
            'bpjs' => '000' . $faker->numerify('########'),
            'inst' => '@' . $faker->userName,
            'face' => $faker->userName,
            'tiktok' => '@' . $faker->userName,
            'twiter' => '@' . $faker->userName,
        ];
    }
}
