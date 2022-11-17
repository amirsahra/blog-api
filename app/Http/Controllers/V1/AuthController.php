<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use App\Http\Requests\V1\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('auth:api')->only('logout');
        $this->middleware('guest')->only(['login','register']);
    }

    public function login(LoginRequest $loginRequest): JsonResponse
    {
        if (auth()->attempt($loginRequest->only('email', 'password'))) {
            $token = auth()->user()->createToken('logon')->accessToken;
            return $this->apiResult(__('messages.auth.login.success'), ['token' => $token]);
        } else
            return $this->apiResult(__('messages.auth.failed'), null, false, 401);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return $this->apiResult(__('messages.auth.logout'));
    }

    public function register(RegisterRequest $registerRequest,User $user): JsonResponse
    {
        $registerUser = $user->newUser($registerRequest);
        return $this->apiResult(__('messages.auth.register'), $registerUser);
    }

}
