<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use Mockery;
use App\Services\AuthService;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class AuthServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_login_success_returns_user_and_token()
    {
        $email = 'test@example.com';
        $plain = 'secret';
        $hashed = Hash::make($plain);

        $user = new User(['email' => $email, 'password' => $hashed]);

        $repoMock = Mockery::mock(UserRepositoryInterface::class);
        $repoMock->shouldReceive('findByEmail')->with($email)->andReturn($user);

        // Mock JWTAuth facade
        JWTAuth::shouldReceive('fromUser')->with($user)->andReturn('fake-jwt-token');

        $service = new AuthService($repoMock);

        $result = $service->login(['email' => $email, 'password' => $plain]);

        $this->assertIsArray($result);
        $this->assertEquals('fake-jwt-token', $result['token']);
        $this->assertEquals($user->email, $result['user']->email);
    }

    public function test_login_with_invalid_credentials_returns_null()
    {
        $repoMock = Mockery::mock(UserRepositoryInterface::class);
        $repoMock->shouldReceive('findByEmail')->andReturnNull();

        $service = new AuthService($repoMock);

        $result = $service->login(['email' => 'wrong@example.com', 'password' => 'nope']);

        $this->assertNull($result);
    }

    public function test_register_creates_user_and_returns_token()
    {
        $data = [
            'name' => 'Chamz',
            'email' => 'new@example.com',
            'password' => 'newpass',
        ];

        // Expect repository create to be called and return a User model
        $createdUser = new User(['name' => $data['name'], 'email' => $data['email']]);

        $repoMock = Mockery::mock(UserRepositoryInterface::class);
        $repoMock->shouldReceive('create')->with(Mockery::on(function ($arg) use ($data) {
            // password should be hashed - we just assert email/name are present
            return $arg['email'] === $data['email'] && $arg['name'] === $data['name'] && !empty($arg['password']);
        }))->andReturn($createdUser);

        JWTAuth::shouldReceive('fromUser')->with($createdUser)->andReturn('fake-token-2');

        $service = new AuthService($repoMock);

        $result = $service->register($data);

        $this->assertIsArray($result);
        $this->assertEquals('fake-token-2', $result['token']);
        $this->assertEquals($createdUser->email, $result['user']->email);
    }
}
