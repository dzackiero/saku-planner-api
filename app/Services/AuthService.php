<?php

namespace App\Services;

use App\Data\Auth\EditProfileData;
use Hash;
use App\Models\User;
use App\Data\Auth\LoginData;
use App\Data\Auth\RegisterData;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class AuthService
{
    public function login(LoginData $loginData)
    {
        $user = User::where('email', $loginData->email)->first();
        if (!$user) {
            throw new UnauthorizedException('Invalid credentials');
        }

        if (!Hash::check($loginData->password, $user->password)) {
            throw new UnauthorizedException('Invalid credentials');
        }

        return $this->generateTokenAndReturnResponse($user);
    }

    public function register(RegisterData $registerData): array
    {
        $user = User::where('email', $registerData->email)->first();
        if ($user) {
            throw new BadRequestException('User already exists');
        }

        $password = Hash::make($registerData->password);
        $user = User::create([
            "name" => $registerData->name,
            'email' => $registerData->email,
            'password' => $password,
        ]);

        return $this->generateTokenAndReturnResponse($user);
    }

    public function updateProfile(EditProfileData $profileData): User
    {
        $user = auth()->user();
        $user->update([
            'name' => $profileData->name,
            'email' => $profileData->email,
        ]);
        return $user->refresh();
    }

    public function generateTokenAndReturnResponse(User $user): array
    {
        return [
            'user' => $user,
            'token' => $user->createToken(getDeviceName())->plainTextToken,
        ];
    }

    public function logout()
    {
        request()->user()->currentAccessToken()->delete();
    }

}
