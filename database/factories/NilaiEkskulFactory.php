<?php

namespace Database\Factories;

use App\Models\NilaiEkskul;
use App\Models\Ekskul;
use App\Models\AnggotaKelas;
use Illuminate\Database\Eloquent\Factories\Factory;

class NilaiEkskulFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NilaiEkskul::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $semester = ['ganjil', 'genap'];
        $keterangan = ['sosial', 'spiritual'];
        return [
            'id_anggota_kelas' => AnggotaKelas::inRandomOrder()->first()->id,
            'id_ekskul' => Ekskul::inRandomOrder()->first()->id,
            'semester' => $semester[rand(0, 1)],
            'keterangan' => $keterangan[rand(0, 1)],
            'nilai' => $this->faker->numberBetween(10, 100),
        ];
    }
}
