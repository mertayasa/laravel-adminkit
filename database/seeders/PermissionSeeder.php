<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routeCollection = Route::getRoutes();
        $ignore_route = [
            'ignition',
            'login',
            'logout',
            'register',
            'password',
        ];
    
        foreach ($routeCollection as $value) {
            if(strConInArray($ignore_route, $value->getName()) && $value->getName() != null){
                $permission = [
                    'name' => $value->getName(),
                    'guard_name' => 'web'
                ];

                Permission::updateOrCreate(['name' => $permission['name']], $permission);
            }
        }
    }
}
