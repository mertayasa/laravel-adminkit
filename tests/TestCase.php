<?php

namespace Tests;

use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleHasPermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\File;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleSeeder::class);
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleHasPermissionSeeder::class);
    }

    public function createAdmin()
    {
        $user = User::factory()->create();

        $user->assignRole(User::$admin);
        return $user;
    }

    public function createStaff()
    {
        $user = User::factory()->create();

        $user->assignRole(User::$staff);
        return $user;
    }

    public function deleteFile($path): void
    {
        if(File::exists(public_path($path))){ 
            File::delete(public_path($path));
        };
    }

}
