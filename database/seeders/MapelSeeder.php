<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mapel;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mapel = [
            [
                'nama' => 'Matematika',
                'is_lokal' => 'false'

            ],
            [
                'nama' => 'Bahasa Indonesia',
                'is_lokal' => 'false'

            ],
            [
                'nama' => 'PPKN',
                'is_lokal' => 'false'

            ],
            [
                'nama' => 'IPA',
                'is_lokal' => 'false'

            ],
            [
                'nama' => 'IPS',
                'is_lokal' => 'false'

            ],
            [
                'nama' => 'Bahasa Bali',
                'is_lokal' => 'true'

            ],
        ];
        foreach ($mapel as $data) {
            Mapel::updateOrCreate(['nama' => $data['nama']], $data);
        }
    }
}
