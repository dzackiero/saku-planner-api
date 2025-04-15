<?php

namespace App\Http\Controllers;

use App\Data\Auth\LoginData;
use App\Data\Auth\RegisterData;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function register(RegisterData $registerData, AuthService $service)
    {
        $user = $service->register($registerData);
        return $this->successResponse($user);
    }

    public function login(LoginData $loginData, AuthService $service)
    {
        $user = $service->login($loginData);
        return $this->successResponse($user);
    }

    public function me()
    {
        $user = request()->user();
        return $this->successResponse($user);
    }

    public function logout(AuthService $authService)
    {
        $authService->logout();
        return $this->successResponse();
    }
}
