<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function get_registrar_users()
    {

        $users = User::role('REGISTRAR')->get();
        return response()->json([
            'users' => $users
        ], 200);
    }

    public function add_registrar_user(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('REGISTRAR');

        return response()->json([
            'message' => 'User Created Successfully',
            'user' => $user
        ], 200);
    }

    public function get_user($id)
    {
        $user = User::findOrfail($id);
        return response()->json([
            'user' => $user
        ], 200);
    }

    public function update_user(Request $request, $id)
    {
        $request->validate([
            'name' => ['string'],
            'email' => ['email', 'unique:users,email,' . $id],
        ]);


        $user = User::findOrfail($id);
        $user->update($request->all());
        return response()->json([
            'message' => 'User Updated Successfully',
            'user' => $user
        ], 200);
    }

    public function delete_user($id)
    {
        $user = User::findOrfail($id);
        $user->delete();
        return response()->json([
            'message' => "User Deleted Successfully"
        ]);
    }
}
