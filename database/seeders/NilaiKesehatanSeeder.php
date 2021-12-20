<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NilaiKesehatan;

class NilaiKesehatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NilaiKesehatan::factory()->count(20)->create();
    }
}
