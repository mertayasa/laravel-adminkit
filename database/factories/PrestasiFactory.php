<?php

namespace Database\Factories;

use App\Models\Prestasi;
use App\Models\AnggotaKelas;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrestasiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prestasi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $semester = ['ganjil', 'genap'];
        return [
            'id_anggota_kelas' => AnggotaKelas::inRandomOrder()->first()->id,
            'semester' => $semester[rand(0, 1)],
            'nama' => $this->faker->title(),
            'keterangan' => $this->faker->text(50),

        ];
    }
}
