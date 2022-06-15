<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    // Refresh the database before each test
    use RefreshDatabase;
    
    public function test_redirect_root_to_login_screen()
    {
        // Visit the root page
        $response = $this->get('/');

        // Assert that the response is a redirect to login page
        $response->assertRedirect('/login');
    }

    public function test_login_screen_can_be_rendered()
    {
        // Visit the login page
        $response = $this->get('/login');

        // Assert that the response is successful
        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        // Create an admin user
        $user = $this->createAdmin();

        // Proccess the login request
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        // Assert that the user is logged in
        $this->assertAuthenticated();
        // Assert that the user is redirected to the dashboard
        $response->assertRedirect('/dashboard');
    }

    public function test_users_failed_to_authenticate_using_wrong_credentials()
    {
        // Proccess the login request with wrong credentials
        
        $response = $this->post('/login', [
            'email' => 'wrongemail@demo.com',
            'password' => 'wrongpass',
        ]);

        $this->assertInvalidCredentials([
            'email' => 'wrongemail@demo.com',
            'password' => 'wrongpass',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('email');
    }
}
