<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService= $authService;
    }

    public function login(LoginRequest $request):JsonResponse
    {
        $credentials =$request->validated();

        $user = $this->authService->login($credentials);

        if(!$user)
        {
            return response()->json(['message'=>'Invalid Credentials'],401);
        }

        return response()->json([
            'message'=>'Login Successful',
            'user'=>$user
        ]);
    }

    public function logout():JsonResponse
    {
        $this->authService->logout();
        return response()->json(['message'=>'Logout successful'],200);
    }

    public function getAuthenticatedUser(): JsonResponse
    {
        $user = $this->authService->getAuthenticatedUser();

        if(!$user)
        {
            return response()->json(['message'=>'No authenticated user'],401);
        }
        return response()->json(['user'=>$user],200);
    }


}
