<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\V1\ForgotPasswordRequest;
use App\Traits\ApiResponse;
use Hash;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use ApiResponse;

    public function forgotPassword(ForgotPasswordRequest $forgotPasswordRequest)
    {
        $link = Password::sendResetLink($forgotPasswordRequest->only('email'));
        return $this->apiResult(__('messages.auth.forgot.send_email'), $link);
    }

    public function resetPassword(ResetPasswordRequest $resetPasswordRequest)
    {
        $response = Password::reset($resetPasswordRequest->all(), function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        });

        if ($response == Password::PASSWORD_RESET)
            $message = __('messages.auth.forgot.success');
        else
            $message = __('messages.auth.forgot.failed');
        return $this->apiResult(__($message));
    }
}
