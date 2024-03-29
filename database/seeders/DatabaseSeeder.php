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
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleHasPermissionSeeder::class);
        $this->call(JabatanSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(UserSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
