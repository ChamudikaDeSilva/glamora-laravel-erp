<?php
namespace App\Repositories;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email): ?User
    {
        $user = User::where('email',$email)->first();
        return $user;
    }

    public function findById(int $id): ?User
    {
        $user = User::find($id);
        return $user;
    }
}
