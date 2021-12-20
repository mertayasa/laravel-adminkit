<?php

namespace Database\Seeders;

use App\Models\NilaiEkskul;
use Illuminate\Database\Seeder;

class NilaiEkskulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NilaiEkskul::factory()->count(20)->create();
    }
}
