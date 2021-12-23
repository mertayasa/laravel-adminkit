<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
                $explode_name = explode('.', $value->getName());
                if(count($explode_name) > 1){
                    unset($explode_name[0]);
                }
                
                $implode_name = implode(' ', $explode_name);

                $new_name = Str::title((str_replace('_', ' ', $implode_name)));
                $permission = [
                    'name' => $value->getName(),
                    'guard_name' => 'web',
                    'alias' => $new_name
                ];

                Permission::updateOrCreate(['name' => $permission['name']], $permission);
            }
        }
    }
}
