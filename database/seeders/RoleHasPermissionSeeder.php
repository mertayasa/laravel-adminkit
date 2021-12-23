<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\RoleHasPermission;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', User::$admin)->first();
        if($role){
            $permission = Permission::all();
            foreach($permission as $permis){
                $role->givePermissionTo($permis->id);
            }
        }
    }
}
