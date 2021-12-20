<?php

namespace Database\Factories;

use App\Models\NilaiProporsi;
use App\Models\AnggotaKelas;
use Illuminate\Database\Eloquent\Factories\Factory;

class NilaiProporsiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NilaiProporsi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $semester = ['ganjil', 'genap'];
        $jenis_proporsi = ['tinggi', 'berat'];
        return [
            'id_anggota_kelas' => AnggotaKelas::inRandomOrder()->first()->id,
            'semester' => $semester[rand(0, 1)],
            'jenis_proporsi' => $jenis_proporsi[rand(0, 1)],
            'nilai' => $this->faker->numberBetween(10, 100),
            'keterangan' => $this->faker->text(50),

        ];
    }
}
