<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\User;
use App\Models\UserPersonal;

class AdminApplicationController extends Controller
{
    public function applications(Request $request) {
        $query = Application::query();
        return $query->with('user')->paginate(10);
    }
    public function applicationsByUser(Request $request, String $user_id)
    {
        $id = $user_id;
        $application = $application = Application::with([
            'user.personalInfo'
        ])->where('users_id', $id)->paginate(10);
        
        
        return response()->json($application);
    }

    public function usersRegistered(Request $request)
    {
        $users = User::with('applications')->get();
        return response()->json($users);
    }

    public function usersWithApplications(Request $request)
    {
        $users = User::whereHas('applications')->paginate(10);
        return response()->json($users);
    }

    public function userWithApplications(Request $request, $userId)
    {
        $user = User::with('applications', 'personalInfo')->findOrFail($userId);
        return response()->json($user);
    }

    public function editApplication(Request $request, $applicationId)
    {
        $application = Application::findOrFail($applicationId);
        $data_personal = $request->validate([
            'loan_type' => 'nullable|string|in:personal,home,auto',
            'loan_amount' => 'required|numeric|min:0',
            'loan_term_months' => 'required|integer|min:1',
            'monthly_income' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:pending,approved,rejected',
            'notes' => 'nullable|string',
            'application_date' => 'nullable|date',
        ]);
        $application->update($data_personal);
        return response()->json($application);
    }

    public function editUser(Request $request, $userId)
    {
        $id = $userId;
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
}
