<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ekskul;

class EkskulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ekskul = [
            [
                'nama' => 'Olahraga',
            ],
            [
                'nama' => 'Tari',
            ],
            [
                'nama' => 'Pramuka',
            ],

        ];
        foreach ($ekskul as $data) {
            Ekskul::updateOrCreate(['nama' => $data['nama']], $data);
        }
    }
}
