<?php
namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected UserRepositoryInterface $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login(array $credentials)
    {
        $user = $this->userRepo->findByEmail($credentials['email']);

        if($user && Hash::check($credentials['password'], $user->password))
        {
            Auth::login($user);
            return $user;
        }
        else
        {
            return null;
        }
    }

    public function logout():void
    {
        Auth::logout();
    }
}
