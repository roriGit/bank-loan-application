<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplicationController;

Route::get('/user', function (Request $request) {
    return User::first(); // just return first user for testing
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Protected routes for the admin

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {





// Users CRUD routes
Route::apiResource('applications', ApplicationController::class);


// Applications
    Route::apiResource('applications', ApplicationController::class);
    Route::get('/applications', [ApplicationController::class, 'index']);
    Route::put('/applications/{application}', [ApplicationController::class, 'update']);

    // Users CRUD routes
    Route::apiResource('users', UserController::class);
    // Personal Info (nested under user)
    Route::get('/users', [UserController::class, 'usersRegistered']);
    Route::get('/user/{user}', action: [ApplicationController::class, 'userWithApplications']);
    Route::post('/users/{user}', [UserController::class, 'store']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::get('/me', [AuthController::class, 'profile']);
});
