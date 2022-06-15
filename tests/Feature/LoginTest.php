<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_redirect_root_to_login_screen()
    {
        $response = $this->get('/');

        $response->assertRedirect('/login');
    }

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = $this->createAdmin();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard');
    }

    public function test_users_failed_to_authenticate_using_wrong_credentials()
    {
        $this->assertInvalidCredentials([
            'email' => 'wrongemail@demo.com',
            'password' => 'wrongpass',
        ]);

        $response = $this->post('/login', [
            'email' => 'wrongemail@demo.com',
            'password' => 'wrongpass',
        ]);

        $response->assertRedirect('/');
    }
}
