<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\Http\Controllers\AuthController;
use App\Services\AuthService;


class LoginTest extends TestCase
{
    public function test_valid_credentials_should_return_success_response()
    {
        $credentials = [
            'email' => 'validemail@example.com',
            'password' => 'validpassword',
        ];

        $mockedAuthService = $this->mock(AuthService::class);

        $mockedAuthService->shouldReceive('attemptLogin')->once()->with($credentials)->andReturn(['user' => ['id' => 1]]);

        $request = Request::create('/login', 'POST', $credentials);

        $authController = new AuthController($mockedAuthService);

        $response = $authController->login($request);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals('Login successful', $response->original['message']);
    }

    public function test_invalid_credentials_should_return_error_response()
    {
        $credentials = [
            'email' => 'validemail@example.com',
            'password' => 'validpassword',
        ];

        $mockedAuthService = $this->mock(AuthService::class);

        $mockedAuthService->shouldReceive('attemptLogin')->once()->with($credentials)->andReturnNull();

        $request = Request::create('/login', 'POST', $credentials);

        $authController = new AuthController($mockedAuthService);

        $response = $authController->login($request);

        $this->assertEquals(401, $response->getStatusCode());

        $this->assertEquals('Invalid credentials', $response->original['message']);
    }
}
