<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelas = [
            [
                'kode' => 'Kelas I',
                'jenjang' => '1'

            ],
            [
                'kode' => 'Kelas II',
                'jenjang' => '2'

            ],
            [
                'kode' => 'Kelas III',
                'jenjang' => '3'

            ],
            [
                'kode' => 'Kelas IV',
                'jenjang' => '4'

            ],
            [
                'kode' => 'Kelas V',
                'jenjang' => '5'

            ],
            [
                'kode' => 'Kelas VI',
                'jenjang' => '6'

            ],
        ];
        foreach ($kelas as $data) {
            Kelas::updateOrCreate(['kode' => $data['kode']], $data);
        }
    }
}
