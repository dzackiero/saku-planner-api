<?php

namespace App\Services;

use Hash;
use App\Models\User;
use App\Data\Auth\LoginData;
use App\Data\Auth\RegisterData;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class AuthService
{
    /**
     * Logs in a user and generates an authentication token.
     *
     * @param LoginData $loginData The data required for user login.
     * @return array{
     *     user: \App\Models\User, // The authenticated User model instance.
     *     token: string // The generated plain text token for the user.
     * } An array containing the authenticated user and their authentication token.
     * @throws UnauthorizedException If the credentials are invalid.
     */
    public function login(LoginData $loginData)
    {
        $user = User::where('email', $loginData->email)->first();
        if (!$user) {
            throw new BadRequestException('User with this email does not exist');
        }

        if (!Hash::check($loginData->password, $user->password)) {
            throw new UnauthorizedException('Invalid credentials');
        }

        return $this->generateTokenAndReturnResponse($user);
    }

    /**
     * Registers a new user.
     *
     * @param RegisterData $registerData The data required for user registration.
     * @return array{
     *     user: \App\Models\User, // The newly created User model instance.
     *     token: string // The generated plain text token for the user.
     * } An array containing the created user and their authentication token.
     * @throws BadRequestException If the user already exists.
     */
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
