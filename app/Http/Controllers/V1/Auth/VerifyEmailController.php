<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware(['signed', 'throttle:6,1'])->only('verify');
        $this->middleware(['auth:api', 'throttle:6,1'])->only('resend');
    }

    public function verify($user_id, Request $request)
    {
        if (!$request->hasValidSignature()) {
            return $this->apiResult(__('messages.auth.email_verify.invalid'), null, false, 401);
        }

        $user = User::findOrFail($user_id);
        if ($user->hasVerifiedEmail()) {
            return $this->apiResult(__('messages.auth.email_verify.already'));
        }

        $user->markEmailAsVerified();
        return $this->apiResult(__('messages.auth.email_verify.success'));

    }

    public function resend(Request $request): JsonResponse
    {
        $request->user()->sendEmailVerificationNotification();
        //return back()->with('message', 'Verification link sent!');
        return $this->apiResult(__('messages.auth.verify.resend'));
    }
}
