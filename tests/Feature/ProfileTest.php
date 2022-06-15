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
        parent::setUp();

        $this->actingAs($this->createAdmin());
    }

    public function test_profile_screen_can_be_rendered()
    {
        $response = $this->get('/setting/profile');

        $response->assertStatus(200);
    }

    public function test_users_failed_to_update_profile()
    {
        $response = $this->patch('/setting/profile/update', [
            'name' => '',
            'email' => '',
            'password' => 'asdasd',
            'password_confirmation' => '',
        ]);

        $response->assertStatus(302);
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

        $user = User::find(Auth::id());
        $response->assertRedirect(route('setting.profile.index'));
        $response->assertSessionHasNoErrors();
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

        $user = User::find(Auth::id());

        $response->assertRedirect(route('setting.profile.index'));
        $response->assertSessionHasNoErrors();
        $this->assertEquals('New Name', $user->name);
        $this->assertEquals('newemail@demo.com' ,$user->email);
        $this->assertTrue(password_verify('newpassword', $user->password));
    }
}
