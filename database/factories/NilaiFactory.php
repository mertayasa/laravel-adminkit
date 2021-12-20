<?php

namespace Database\Factories;

use App\Models\Nilai;
use App\Models\AnggotaKelas;
use App\Models\Jadwal;
use Illuminate\Database\Eloquent\Factories\Factory;

class NilaiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Nilai::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_anggota_kelas' => AnggotaKelas::inRandomOrder()->first()->id,
            'id_jadwal' => Jadwal::inRandomOrder()->first()->id,
            'tugas' => $this->faker->numberBetween(10, 100),
            'uts' => $this->faker->numberBetween(10, 100),
            'uas' => $this->faker->numberBetween(10, 100),
            'desk_pengetahuan' => $this->faker->text(50),
            'desk_keterampilan' => $this->faker->text(50),

        ];
    }
}
