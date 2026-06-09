<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Api\BaseController;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return $this->success(
            [
                'user' => $user,
                'token' => $token
            ],
            'User registered',
            201
        );
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            return $this->error(
                'The provided credentials are incorrect.',
                401
            );
        }

        $user->tokens()->delete();

        $token = $user->createToken('api-token')->plainTextToken;

        return $this->success(
            [
                'user' => $user,
                'token' => $token
            ],
            'User logged in'
        );
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->success(
            null,
            'User logged out'
        );
    }
}