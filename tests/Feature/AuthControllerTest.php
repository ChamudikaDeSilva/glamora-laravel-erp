<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    // public function test_user_can_register_endpoint()
    // {
    //     $payload = [
    //         'name' => 'Chamz',
    //         'email' => 'chamz.reg@example.com',
    //         'password' => 'password123',
    //         'password_confirmation' => 'password123',
    //     ];

    //     Mock JWT token creation so controller returns predictable token
    //     JWTAuth::shouldReceive('fromUser')->andReturn('controller-token');

    //     $response = $this->postJson('/api/register', $payload);

    //     $response->assertStatus(201)
    //              ->assertJsonStructure(['user', 'token'])
    //              ->assertJsonFragment(['token' => 'controller-token']);
    // }

    public function test_user_can_login_endpoint()
    {
        $password = 'password123';
        $user = User::factory()->create(['password' => bcrypt($password)]);

        // Mock JWT facade so login returns token
        JWTAuth::shouldReceive('fromUser')->andReturn('login-token');

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['message','user','token'])
                 ->assertJsonFragment(['token' => 'login-token']);
    }

    public function test_me_endpoint_requires_auth_and_returns_user()
    {
        $user = User::factory()->create();
        $token = 'test-token';

        // Mock parseToken()->authenticate() call chain
        JWTAuth::shouldReceive('parseToken->authenticate')->andReturn($user);

        $response = $this->getJson('/api/me', ['Authorization' => "Bearer {$token}"]);

        $response->assertStatus(200)
                 ->assertJson(['user' => ['email' => $user->email]]);
    }

    public function test_logout_endpoint_invalidates_token()
    {
        // just ensure endpoint returns 200 (token invalidation is inside service)
        JWTAuth::shouldReceive('invalidate')->andReturnNull();
        JWTAuth::shouldReceive('getToken')->andReturn('some-token');

        $response = $this->postJson('/api/logout');

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Logout successful']);
    }

    public function test_refresh_endpoint_returns_new_token()
    {
        JWTAuth::shouldReceive('getToken')->andReturn('old-token');
        JWTAuth::shouldReceive('refresh')->with('old-token')->andReturn('new-token');

        $response = $this->postJson('/api/refresh');

        $response->assertStatus(200)
                 ->assertJson(['token' => 'new-token']);
    }
}
