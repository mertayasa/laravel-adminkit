<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create('id_ID');
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@demo.com',
                'status' => User::$active,
                'email_verified_at' => now(),
                'password' => bcrypt('asdasdasd'), // password
                'remember_token' => Str::random(10),
            ],
        ];

        foreach ($users as $user) {
            $new_user = User::updateOrCreate(['email' => $user['email']], $user);

            if(!is_bool($new_user)){
                $new_user->assignRole(User::$admin);
            }
        }
    }
}
