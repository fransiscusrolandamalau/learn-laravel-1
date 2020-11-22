<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::get('refresh', [AuthController::class, 'refresh']);
        Route::middleware('auth:api')->group(function () {
            Route::get('user', [AuthController::class, 'user']);
            Route::post('logout', [AuthController::class, 'logout']);
        });
    });

    Route::middleware('auth:api')->group(function () {
        Route::resource('user', 'UserController')->only(['index', 'show']);
    });
});