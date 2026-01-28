<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $query = Application::query();
        return $query->with('user')->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data_personal =$request->validate([
            'users_id' => 'required|exists:users,id',
            'loan_type' => 'nullable|string|in:personal,home,auto',
            'loan_amount' => 'required|numeric|min:0', 
            'loan_term_months' => 'required|integer|min:1',
            'monthly_income' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:pending,approved,rejected',
            'notes' => 'nullable|string', 
            'application_date' => 'nullable|date',
        ]);
        $application = Application::create($data_personal);
        return response()->json($application, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->user_id;
        $application = Application::with('user')->findOrFail($id);
        return response()->json($application);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd(Auth::user()->role);
        if(Auth::user()->id!=$id && Auth::user()->role!='admin'){
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $application = Application::findOrFail($id);
        $data_personal = $request->validate([
            'loan_type' => 'sometimes|string|in:personal,home,auto',
            'loan_amount' => 'sometimes|numeric|min:0',
            'loan_term_months' => 'sometimes|integer|min:1',
            'monthly_income' => 'sometimes|numeric|min:0',
            'notes' => 'sometimes|string',
        ]);
        if (Auth::user()->role === 'admin') {
            $request->validate([
                'application_date' => 'sometimes|date',
                'status' => 'required|string|in:pending,approved,rejected',
            ]);
            $data_personal['status'] = $request->status;
        }
        $application->update($data_personal);
        return response()->json($application);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    public function applicationsByUser(Request $request, String $user)
    {
        $application = Application::with([
            'user',
            'user.personalInfo'
        ])->where('users_id', $user)->paginate(10);
        
        return response()->json($application);
    }
}
