<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@demo.com',
                'email_verified_at' => now(),
                'password' => bcrypt('asdasdasd'), // password
                'remember_token' => Str::random(10),
            ]
        ];

        foreach($users as $user){
            User::updateOrCreate(['email' => $user['email']], $user);
        }
    }
}
