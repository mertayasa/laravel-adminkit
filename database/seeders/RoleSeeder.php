<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'guard_name' => 'web'
            ],
            [
                'name' => 'staff',
                'guard_name' => 'web'
            ]
        ];

        foreach($roles as $role){
            Role::updateOrCreate(['name' => $role['name']], $role);
        }
    }
}
