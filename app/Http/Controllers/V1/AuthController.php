<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('auth:api')->only('logout');
        $this->middleware('guest')->only('login');
    }

    public function login(LoginRequest $loginRequest)
    {
        if (auth()->attempt($loginRequest->only('email', 'password'))) {
            $token = auth()->user()->createToken('logon')->accessToken;
            return $this->apiResult(__('messages.auth.login.success'), ['token'=>$token]);
        } else
            return $this->apiResult(__('messages.auth.failed'), null, false, 401);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->apiResult(__('messages.auth.logout'));
    }

}
