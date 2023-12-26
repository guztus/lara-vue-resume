<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function Login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!$this->guard()->attempt($credentials)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect'
            ], 422);
        }
        $this->guard()->attempt($credentials);
        $token = $this->guard()->user()->createToken('auth-token')->plainTextToken;

        return response()->json([
            'user' => Auth::user(),
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'Successfully logged in!'
        ], 200);
    }


    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->tokens()->delete();
            $this->guard()->logout();
        }
        return response()->json([
            'status_code' => '200',
            'message' => 'logged out successfully'
        ]);
    }

    public function guard($guard = 'web')
    {
        return Auth::guard($guard);
    }
}
