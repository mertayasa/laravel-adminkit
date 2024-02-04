<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($jabatan=1; $jabatan <= 10; $jabatan++) { 
            Jabatan::updateOrCreate(['nama' => 'jabatan '.$jabatan],[
                'nama' => 'jabatan '.$jabatan
            ]);
        }
    }
}
