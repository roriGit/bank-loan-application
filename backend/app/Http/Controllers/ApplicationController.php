<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

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
        //
        $data = $request->validate([
            'users_id' => 'required|exists:users,id',
            'status' => 'required|string',
            'amount' => 'required|numeric',
            // Add other fields and their validation rules as necessary
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
