<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SpecialtyController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/me', [AuthController::class, 'me']);

    Route::middleware('permission')->group(function () {

        Route::apiResource('users', UserController::class);

        Route::patch('/users/{user}/status',
            [UserController::class, 'updateStatus']
        );
        Route::apiResource('specialties', SpecialtyController::class);
    });

});