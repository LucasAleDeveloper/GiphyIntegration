<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        $data = $this->authService->attemptLogin($credentials);

        if ($data) {
            return response()->json(['message' => 'Login successful', 'data' => $data], 200);
        } 

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
