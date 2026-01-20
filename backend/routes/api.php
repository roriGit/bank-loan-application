<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\UserPersonalController;

// Test route (optional)
Route::get('/user', function () {
    return User::first();
});

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/me', [AuthController::class, 'me']);

// Users CRUD
Route::middleware('auth:sanctum')->apiResource('users', UserController::class);

// User Personal Info (nested)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('users/{user}/personal-info', [UserPersonalController::class, 'show']);
    Route::post('users/{user}/personal-info', [UserPersonalController::class, 'store']);
    Route::put('users/{user}/personal-info', [UserPersonalController::class, 'update']);
});

// Applications
Route::middleware('auth:sanctum')->apiResource('applications', ApplicationController::class);

// Applications by user
Route::middleware('auth:sanctum')->get('users/{user}/applications', [ApplicationController::class, 'applicationsByUser']);
