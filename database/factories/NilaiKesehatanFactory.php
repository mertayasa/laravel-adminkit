<?php

namespace Database\Factories;

use App\Models\NilaiKesehatan;
use App\Models\AnggotaKelas;
use Illuminate\Database\Eloquent\Factories\Factory;

class NilaiKesehatanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NilaiKesehatan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $semester = ['ganjil', 'genap'];
        $jenis_kesehatan = ['pendengaran', 'penglihatan', 'gigi', 'lain'];
        return [
            'id_anggota_kelas' => AnggotaKelas::inRandomOrder()->first()->id,
            'semester' => $semester[rand(0, 1)],
            'jenis_kesehatan' => $jenis_kesehatan[rand(0, 3)],
            'nilai' => $this->faker->numberBetween(10, 100),
            'keterangan' => $this->faker->text(50),

        ];
    }
}
