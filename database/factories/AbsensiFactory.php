<?php

namespace Database\Factories;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\AnggotaKelas;
use Illuminate\Database\Eloquent\Factories\Factory;

class AbsensiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Absensi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $kehadiran = ['hadir', 'sakit', 'ijin', 'alpa'];
        return [
            'id_anggota_kelas' => AnggotaKelas::inRandomOrder()->first()->id,
            'id_jadwal' => Jadwal::inRandomOrder()->first()->id,
            'kehadiran' => $kehadiran[rand(0, 3)],
        ];
    }
}
