<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\storeUserRequest;
use App\Models\User;
use App\Services\UsernameGenerator;

class RegistrarUsersController extends Controller
{
    public function index()
    {
        // sleep(3);
        $users = User::role('REGISTRAR')->get();
        return response()->json([
            'users' => $users
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $username = UsernameGenerator::generate("REGISTRAR");
        $user = User::create([
            'email' => $request->email,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'username' => $username,
            'password' => bcrypt('password')
        ]);

        $user->assignRole('REGISTRAR');

        return response()->json([
            'user' => $user
        ], 201);
    }

    public function show(User $user)
    {
        return response()->json([
            'user' => $user
        ]);
    }
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([

            'first_name' => ['sometimes', 'string', 'min:3', 'max:255'],
            'middle_name' => ['sometimes', 'string', 'min:3', 'max:255'],
            'last_name' => ['sometimes', 'string', 'min:3', 'max:255'],
            'email' => ['sometimes', 'email', 'unique:users,email,' . $user->id],
        ]);


        $user->update($validated);

        return response()->json([
            'user' => $user
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted'
        ]);
    }
}
