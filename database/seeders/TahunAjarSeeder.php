<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TahunAjar;

class TahunAjarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tahun_ajar = [
            [
                'keterangan' => 'asdasdasd',
                'tahun_mulai' => '2021',
                'tahun_selesai' => '2022'
            ],

        ];
        foreach ($tahun_ajar as $data) {
            TahunAjar::updateOrCreate(['keterangan' => $data['keterangan']], $data);
        }
    }
}
