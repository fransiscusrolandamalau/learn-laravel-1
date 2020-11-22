<?php

namespace Tests\Feature;

use App\Models\User;
use Config;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JWTAuth;
use Tests\TestCase;

class JWTAuthTest extends TestCase
{
    public function testLogin()
    {
        $baseUrl = Config::get('app.url') . 'api/auth/login';
        $email = 'john@test.com';
        $password = 'test';

        $response = $this->json('POST', $baseUrl.'/', [
            'email' => $email,
            'password' => $password
        ]);

        $response
                ->assertStatus(200)
                ->assertJsonStructure([
                    'access_token', 'token_type', 'expires_in'
                ]);
    }

    public function testLogout()
    {
        $user = User::whereEmail('john@test.com')->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = Config::get('app.url') . 'api/auth/logout?token=' . $token;

        $response = $this->json('POST', $baseUrl, []);

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'message' => 'Successfully logged out'
            ]);
    }

    public function testRefresh()
    {
        $user = User::where('email', 'john@test.com')->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = Config::get('app.url') . 'api/auth/logout?token=' . $token;

        $response = $this->json('POST', $baseUrl, []);

        $response
                ->assertStatus(200)
                ->assertJsonStructure([
                    'access_token', 'token_type', 'expires_in'
                ]);
    }

    public function testGetUsers()
    {
        $user = User::where('email', 'john@test.com')->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = Config::get('app.url') . 'api/users?token=' . $token;

        $response = $this->json('GET', $baseUrl . '/', []);

        $response->assertStatus(200);
    }
}
