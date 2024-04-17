<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function attemptLogin(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $success['token'] = $user->createToken('GiphyIntegrationApp')->accessToken;
            $success['user'] = $user;

            return $success;
        }

        return;
    }
}

?>