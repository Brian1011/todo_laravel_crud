<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Function to handle user registration
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->errors()->all()], 422);
        }

        // Create and save the user
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->save();

        // return user details and access token
        $token = $user->createToken('Personal Access Token')->accessToken;
        return response()->json(['user' => $user, 'access_token' => $token], 201);
    }

    // Function to handle user login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->errors()->all()], 422);
        }

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

    // get user
    // Function to get authenticated user's information
    public function getUser(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            return response()->json(['user' => $user], 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}

