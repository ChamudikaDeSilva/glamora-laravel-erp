<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\UserRepository;
use App\Models\User;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected UserRepository $repo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repo = new UserRepository();
    }

    public function test_create_user()
    {
        $data = [
            'name' => 'Chamz',
            'email' => 'chamz@example.com',
            'password' => bcrypt('secret'),
        ];

        $user = $this->repo->create($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', ['email' => 'chamz@example.com']);
    }

    public function test_find_by_email()
    {
        $user = User::factory()->create(['email' => 'findme@example.com']);
        $found = $this->repo->findByEmail('findme@example.com');

        $this->assertNotNull($found);
        $this->assertEquals($user->id, $found->id);
    }

    public function test_find_by_id()
    {
        $user = User::factory()->create();
        $found = $this->repo->findById($user->id);

        $this->assertNotNull($found);
        $this->assertEquals($user->email, $found->email);
    }
}
