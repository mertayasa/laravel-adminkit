<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
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
                'name' => 'role1',
                'guard_name' => 'web'
            ],
            [
                'name' => 'role2',
                'guard_name' => 'web'
            ],
        ];

        foreach($roles as $role){
            Role::updateOrCreate(['name' => $role['name']], $role);
        }
    }
}
