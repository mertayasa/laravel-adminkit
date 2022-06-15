<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        // Run all the setUp() code defined in parent (TestCase) class
        parent::setUp();

        // Create admin account and login (actingAs)
        $this->actingAs($this->createAdmin());
    }

    public function test_profile_screen_can_be_rendered()
    {
        // Visit the profile page
        $response = $this->get('/setting/profile');
        $response->assertStatus(200);
    }

    public function test_users_failed_to_update_profile()
    {
        // Send wrong request to update the profile
        $response = $this->patch('/setting/profile/update', [
            'name' => '',
            'email' => '',
            'password' => 'asdasd',
            'password_confirmation' => '',
        ]);

        // Assert that redirect
        $response->assertStatus(302);

        // Assert if session has error message
        $response->assertSessionHasErrors('name');
        $response->assertSessionHasErrors('email');
        $response->assertSessionHasErrors('password');
    }

    public function test_users_can_update_their_profile()
    {
        $response = $this->patch('/setting/profile/update', [
            'name' => 'New Name',
            'email' => 'newemail@demo.com',
        ]);

        // Find the user and assert that the name and email are updated
        $user = User::find(Auth::id());

        $response->assertRedirect(route('setting.profile.index'));
        $response->assertSessionHasNoErrors(); // Assert that session has no error message
        $this->assertEquals('New Name', $user->name);
        $this->assertEquals('newemail@demo.com', $user->email);
    }

    public function test_users_can_update_their_profile_with_new_password()
    {
        $response = $this->patch('/setting/profile/update', [
            'name' => 'New Name',
            'email' => 'newemail@demo.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ]);

        // Find the user and assert that the name, email, and password are updated
        $user = User::find(Auth::id());

        $response->assertRedirect(route('setting.profile.index'));
        $response->assertSessionHasNoErrors(); // Assert that session has no error message
        $this->assertEquals('New Name', $user->name);
        $this->assertEquals('newemail@demo.com' ,$user->email);
        $this->assertTrue(password_verify('newpassword', $user->password));
    }
}
