<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NilaiSikap;

class NilaiSikapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NilaiSikap::factory()->count(20)->create();
    }
}
