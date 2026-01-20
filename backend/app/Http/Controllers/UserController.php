<?php

namespace App\Http\Controllers;

use App\Models\UserPersonal;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return response()->json(data: User::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $id = $request->user_id;
        $user_data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            // Add other fields and their validation rules as necessary
        ]);
        $user_personal_data = $request->validate([
            'contact_number' => 'sometimes|nullable|string|max:20',
            'employment_status' => 'sometimes|boolean',
            'employment_type' => 'sometimes|nullable|string|max:100',
            'date_of_birth' => 'sometimes|nullable|date',
            'address' => 'sometimes|nullable|string|max:255',
            'city' => 'sometimes|nullable|string|max:100',
            'province' => 'sometimes|nullable|string|max:100',
            'postal_code' => 'sometimes|nullable|string|max:20',
            'country' => 'sometimes|nullable|string|max:100',
        ]);
        
        $user = User::findOrFail($id);
        $user_personal = UserPersonal::where('users_id', $id)->first();
        
        $userUpdated = $user->update($user_data);
        $userPersonalUpdated = $user_personal->update($user_personal_data);

        // Return response on whether any update occurred on the user or personal info
        return response()->json([
            'success' => $userUpdated || $userPersonalUpdated,
            'message' => ($userUpdated || $userPersonalUpdated) 
                ? 'User updated successfully.' 
                : 'No changes were made to the user or personal info.',
            'data' => [
                'user' => $user,
                'user_personal' => $user_personal
            ],
            'updated' => [
                'user' => $userUpdated,
                'user_personal' => $userPersonalUpdated
            ]
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
