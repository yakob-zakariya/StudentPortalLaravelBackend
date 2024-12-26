<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\storeUserRequest;
use App\Models\User;

class RegistrarUsersController extends Controller
{
    public function index()
    {
        $users = User::role('REGISTRAR')->get();
        return response()->json([
            'users' => $users
        ]);
    }

    public function store(StoreUserRequest $request)
    {

        $user = User::create([
            'email' => $request->email,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'username' => 'REG/1212/2021',
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
        $request->validate([
            'email' => ['email', 'unique:users,email,' . $user->id],
            'name' => ['string'],
        ]);


        $user->update([
            'email' => $request->email,
            'name' => $request->name,
        ]);

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
