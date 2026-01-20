<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate incoming request
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // expects password_confirmation field
            'password_confirmation' => 'required|string|min:6',
        ]);

        // Hash the password
        $data['password'] = Hash::make($data['password']);

        // Check if email already exists
        if(User::where('email', $data['email'])->exists()){
            return response()->json(['message' => 'Email already in use'], 409);
        }
        // Create the user
        $user = User::create($data);
        // Optionally: create a token for immediate auth
        $token = $user->createToken('api-token')->plainTextToken;

        // Return response
        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {
        // Validate incoming request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to find the user
        $user = User::where('email', $credentials['email'])->first();

        // Check if user exists and password matches
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Create a new token
        $token = $user->createToken('api-token')->plainTextToken;

        // Return response
        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function me(Request $request)
    {
        // Return the authenticated user with personal info and applications
        $user = $request->user()->load('personalInfo', 'applications');

        return response()->json($user);
    }

}
