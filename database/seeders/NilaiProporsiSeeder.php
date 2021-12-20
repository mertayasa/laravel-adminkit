<?php

namespace Database\Seeders;

use App\Models\NilaiProporsi;
use Illuminate\Database\Seeder;

class NilaiProporsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NilaiProporsi::factory()->count(20)->create();
    }
}
