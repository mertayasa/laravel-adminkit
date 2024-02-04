<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($unit=1; $unit <= 10; $unit++) { 
            Unit::updateOrCreate(['nama' => 'unit '.$unit],[
                'nama' => 'unit '.$unit
            ]);
        }
    }
}
