<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AnggotaKelas;

class AnggotaKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AnggotaKelas::factory()->count(20)->create();
    }
}
