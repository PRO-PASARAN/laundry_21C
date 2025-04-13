<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $payload = [
            'user_id' => $user->id,
            'role' => $user->role,
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24) // 24 hours
        ];

        $token = JWT::encode($payload, env('JWT_SECRET', 'your-secret-key'), 'HS256');

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'faculty' => 'required|string',
            'room' => 'required|string',
            'floor' => 'required|integer|min:0|max:5',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'faculty' => $request->faculty,
            'room' => $request->room,
            'floor' => $request->floor,
            'role' => 'student',
            'is_active' => false, // needs admin approval
        ]);

        return response()->json([
            'message' => 'Registration successful. Please wait for admin approval.',
            'user' => $user
        ]);
    }

    public function me(Request $request)
    {
        return response()->json($request->user);
    }
}
