<?php

namespace Database\Seeders;

use App\Models\WaliKelas;
use Illuminate\Database\Seeder;

class WaliKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WaliKelas::factory()->count(5)->create();
    }
}
