<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(LoginRequest $request)
    {
        $isUserEmailExists = User::where('email', $request->email)->exists();

        if($isUserEmailExists) {
            return response()->json([
                'success' => false,
                'data' => 'There are already users with this email address.'
            ], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'email_verified_at' => now()
        ]);

        $token = $user->createToken('default')->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $token
            ]
        ]);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!$user) {
            return response()->json([
                'success' => false,
                'data' => 'There is no user with this email address.'
            ], 400);
        }

        if(!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'data' => 'Incorrect password.'
            ], 400);
        }

        $token = $user->createToken('default')->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $token
            ]
        ]);
    }

    public function me(Request $request)
    {
        // check if the user is authenticated
        if(!$request->user()) {
            return response()->json([
                'success' => false,
                'data' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'data' => auth()->user()
        ]);
    }
}
