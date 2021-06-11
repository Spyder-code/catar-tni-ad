<?php

namespace Database\Factories;

use App\Models\Calon;
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
        return [
            'no_online' => $this->faker->phoneNumber,
            'nama' => $this->faker->name,
            'agama' => $this->faker->name,
            'tem_lahir' => $this->faker->name,
            'tgl_lahir' => $this->faker->name,
            'suku' => $this->faker->name,
            'alamat' => $this->faker->name,
            'rt' => $this->faker->name, 
            'rw' => $this->faker->name,
            'no' => $this->faker->name,
            'dsn' => $this->faker->name,
            'ds' => $this->faker->name,
            'kec' => $this->faker->name,
            'kab' => $this->faker->name, 
            'telp' => $this->faker->name, 
            'daftar_ke' => $this->faker->name, 
            'aspek_tl' => $this->faker->name, 
        ];
    }
}
