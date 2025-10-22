<?php
namespace App\Repositories\Eloquent;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

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

    public function create(array $data):User
    {
        return User::create($data);
    }
}
