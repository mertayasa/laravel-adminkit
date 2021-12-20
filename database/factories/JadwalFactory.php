<?php

namespace Database\Factories;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\TahunAjar;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class JadwalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Jadwal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        return [
            'id_user' => User::where('level', 'guru')->inRandomOrder()->first()->id,
            'id_kelas' => Kelas::inRandomOrder()->first()->id,
            'id_mapel' => Mapel::inRandomOrder()->first()->id,
            'id_tahun_ajar' => TahunAjar::inRandomOrder()->first()->id,
            'jam_mulai' => $this->faker->time(),
            'jam_selesai' => $this->faker->time(),
            'hari' => $hari[rand(0, 5)],
        ];
    }
}
