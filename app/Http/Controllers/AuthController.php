<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Function to handle user registration
    public function register(Request $request)
    {
        // Validate the request data
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Create and save the user
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->save();

        // Return a response indicating successful registration
        return response()->json(['message' => 'User registered successfully'], 201);
    }

    // Function to handle user login
    public function login(Request $request)
    {
        // Validate the request data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication successful
            $user = Auth::user();
            $token = $user->createToken('Personal Access Token')->accessToken;

            // Return user details and access token
            return response()->json(['user' => $user, 'access_token' => $token], 200);
        } else {
            // Authentication failed
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    // Function to handle user logout
    public function logout(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Revoke all tokens for this user
        $user->tokens()->revoke();

        // Return a response indicating successful logout
        return response()->json(['message' => 'User logged out successfully'], 200);
    }
}

