<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return [
            'token' => $user->createToken('ecommerce-token')->plainTextToken,
            'user' => $user
        ];
    }

    public function register(RegisterRequest $request)
    {
        $user = User::query()
            ->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password'))
            ]);
        return [
            'token' => $user->createToken('ecommerce-token')->plainTextToken,
            'user' => $user
        ];
    }

    public function logout()
    {
        return Auth::user()->tokens()->delete();
    }
}
