<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
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
        //Route::post('edit', [CategoryController::class, 'edit']);
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('brands', BrandController::class);
    });


