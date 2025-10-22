<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;



class LoginController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService= $authService;
    }

//   public function register(RegisterRequest $request): JsonResponse
//     {
//         $data = $request->validated();
//         $result = $this->authService->register($data);

//         return response()->json([
//             'message' => 'User registered successfully',
//             'user' => $result['user'],
//             'token' => $result['token']
//         ], 201);
//     }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        $result = $this->authService->login($credentials);

        if (!$result) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'user' => $result['user'],
            'token' => $result['token'],
        ]);
    }

    public function me(): JsonResponse
    {
        $user = $this->authService->getAuthenticatedUser();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        return response()->json(['user' => $user]);
    }

    public function logout(): JsonResponse
    {
        $this->authService->logout();
        return response()->json(['message' => 'Logout successful'], 200);
    }

    public function refresh(): JsonResponse
    {
        $token = $this->authService->refreshToken();

        if (!$token) {
            return response()->json(['message' => 'Token refresh failed'], 401);
        }

        return response()->json(['token' => $token]);
    }


}
