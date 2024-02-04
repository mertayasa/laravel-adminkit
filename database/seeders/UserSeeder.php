<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\LoginLog;
use App\Models\User;
use App\Models\UserJabatan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{

    public function run()
    {
        // $faker = Faker::create('id_ID');
        $users = [
            [
                'nama' => 'Admin',
                'username' => 'admin',
                'status' => User::$active,
                'password' => bcrypt('asdasdasd'), // password
                'remember_token' => Str::random(10),
                'id_unit' => NULL,
            ],
        ];

        foreach ($users as $user) {
            $new_user = User::updateOrCreate(['username' => $user['username']], $user);

            if(!is_bool($new_user)){
                $new_user->assignRole(User::$admin);
            }
        }

        $count_login = rand(2,50);
        $count_jabatan = rand(1,2);
        
        User::factory()->count(10)->has(LoginLog::factory()->count($count_login))->has(UserJabatan::factory()->count($count_jabatan))->create()->each(function ($user) {
            $user->assignRole(User::$karyawan);
        });;
    }
}
