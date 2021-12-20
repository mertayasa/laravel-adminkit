<?php

namespace Database\Factories;

use App\Models\WaliKelas;
use App\Models\Kelas;
use App\Models\TahunAjar;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WaliKelasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WaliKelas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_user' => User::where('level', 'guru')->inRandomOrder()->first()->id,
            'id_kelas' => Kelas::inRandomOrder()->first()->id,
            'id_tahun_ajar' => TahunAjar::inRandomOrder()->first()->id,
        ];
    }
}
