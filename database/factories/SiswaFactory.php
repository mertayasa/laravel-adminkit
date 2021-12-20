<?php

namespace Database\Factories;

use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Siswa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $kelamin = ['Laki-laki', 'Perempuan'];
        $status = ['aktif', 'Nonaktif'];
        return [
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'nis' => $this->faker->numberBetween(100000000, 200000000),
            'alamat' => $this->faker->address(),
            'tempat_lahir' => $this->faker->address(),
            'tgl_lahir' => $this->faker->dateTimeBetween(Carbon::now()->subYears(13), Carbon::now()->subYears(6)),
            'jenis_kelamin' => $kelamin[rand(0, 1)],
            'id_user' => User::where('level', 'ortu')->inRandomOrder()->first()->id,
            'status' => $status[rand(0, 1)],
        ];
    }
}
