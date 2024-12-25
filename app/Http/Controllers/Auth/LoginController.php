<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {


        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $token = $request->user()->createToken('auth_token')->plainTextToken;

            return response()->json([
                'token' => $token,
                'user' => $request->user()
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }
}
