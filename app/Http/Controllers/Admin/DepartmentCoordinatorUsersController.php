<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\storeUserRequest;
use App\Services\UsernameGenerator;

class DepartmentCoordinatorUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::role('COORDINATOR')->get();
        return response()->json([
            'users' => $users->load('coordinator')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeUserRequest $request)
    {
        $validated = $request->validated();
        $request->validate([
            'department_id' => ['required', 'exists:departments,id']
        ]);
        $username = UsernameGenerator::generate('COORDINATOR');

        $user = User::create([
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'username' => $username,
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('COORDINATOR');
        $user->coordinator()->create([
            'department_id' => $request->department_id
        ]);



        return response()->json([
            'message' => 'Coordinator created successfully',
            'user' => $user
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json([
            'user' => $user->load('coordinator')
        ]);
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
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => 'Coordinator deleted successfully'
        ]);
    }
}
