<?php

namespace Database\Factories;

use App\Models\NilaiSikap;
use App\Models\AnggotaKelas;
use Illuminate\Database\Eloquent\Factories\Factory;

class NilaiSikapFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NilaiSikap::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $semester = ['ganjil', 'genap'];
        $jenis_sikap = ['sosial', 'spiritual'];
        return [
            'id_anggota_kelas' => AnggotaKelas::inRandomOrder()->first()->id,
            'semester' => $semester[rand(0, 1)],
            'jenis_sikap' => $jenis_sikap[rand(0, 1)],
            'nilai' => $this->faker->numberBetween(10, 100),
            'keterangan' => $this->faker->text(50),

        ];
    }
}
