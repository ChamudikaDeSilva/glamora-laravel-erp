<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::post('/login', [LoginController::class, 'login']);
// Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
// Route::get('/get-authenticated-user', [LoginController::class, 'getAuthenticatedUser']);

    Route::post('register', [LoginController::class, 'register']);
    Route::post('login', [LoginController::class, 'login']);
    Route::middleware('auth:api')->group(function () {
        Route::get('me', [LoginController::class, 'me']);
        Route::post('logout', [LoginController::class, 'logout']);
        Route::post('refresh', [LoginController::class, 'refresh']);
    });

