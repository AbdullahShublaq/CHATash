<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AuthUpgradeTest extends TestCase
{
    use DatabaseTransactions;

    public function testRegistrationLoginAndLogout()
    {
        $response = $this->post('/register', [
            'name' => 'Upgrade Tester',
            'email' => 'upgrade-check-'.uniqid().'@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticated();

        $this->post('/logout')->assertRedirect('/');
        $this->assertGuest();

        $user = User::where('name', 'Upgrade Tester')->first();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }
}