<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(SiswaSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(MapelSeeder::class);
        $this->call(EkskulSeeder::class);
        $this->call(TahunAjarSeeder::class);
        $this->call(AnggotaKelasSeeder::class);
        $this->call(JadwalSeeder::class);
        $this->call(AbsensiSeeder::class);
        $this->call(NilaiSeeder::class);
        $this->call(NilaiEkskulSeeder::class);
        $this->call(NilaiSikapSeeder::class);
        $this->call(NilaiKesehatanSeeder::class);
        $this->call(WaliKelasSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
