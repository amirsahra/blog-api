<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('auth:api')->only('logout');
        $this->middleware('guest')->only('login');
    }

    public function login(LoginRequest $loginRequest): JsonResponse
    {
        if (auth()->attempt($loginRequest->only('email', 'password'))) {
            $token = auth()->user()->createToken('logon')->accessToken;
            return $this->apiResult(__('messages.auth.login.success'), ['token' => $token]);
        } else
            return $this->apiResult(__('messages.auth.login.failed'), null, false, 401);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return $this->apiResult(__('messages.auth.logout'));
    }


}
