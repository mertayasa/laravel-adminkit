<?php

namespace Database\Factories;

use App\Models\AnggotaKelas;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kelas;
use App\Models\TahunAjar;
use App\Models\Siswa;

class AnggotaKelasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AnggotaKelas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_kelas' => Kelas::inRandomOrder()->first()->id,
            'id_siswa' => Siswa::inRandomOrder()->first()->id,
            'id_tahun_ajar' => TahunAjar::inRandomOrder()->first()->id,
            'saran' => $this->faker->text(50),
        ];
    }
}
