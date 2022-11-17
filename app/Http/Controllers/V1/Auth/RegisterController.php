<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(RegisterRequest $registerRequest, User $user): JsonResponse
    {
        $registerUser = $user->newUser($registerRequest);
        return $this->apiResult(__('messages.auth.register'), $registerUser);
    }
}
