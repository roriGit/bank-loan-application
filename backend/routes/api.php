<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\UserPersonalController;

Route::get('/user', function (Request $request) {
    return User::first(); // just return first user for testing
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/me', [AuthController::class, 'me']);

// Users CRUD routes
Route::apiResource('users', UserController::class);


// Personal Info (nested under user)
Route::get('users/{user}/personal-info', [UserPersonalController::class, 'show']);
Route::post('users/{user}/personal-info', [UserPersonalController::class, 'store']);
Route::put('users/{user}/personal-info', [UserPersonalController::class, 'update']);

// Users CRUD routes
Route::apiResource('applications', ApplicationController::class);

// Applications
Route::apiResource('applications', ApplicationController::class);
Route::get('users/{user}/applications', [ApplicationController::class, 'applicationsByUser']);
