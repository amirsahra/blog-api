<?php

use App\Http\Controllers\V1\Auth\ForgotPasswordController;
use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\Auth\RegisterController;
use App\Http\Controllers\V1\Auth\VerifyEmailController;
use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\CommentController;
use App\Http\Controllers\V1\PostController;
use App\Http\Controllers\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout']);
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('password.request');
    Route::post('password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset');

    Route::apiResource('user', UserController::class);
    Route::post('users/search', [UserController::class, 'search']);
    Route::apiResource('category', CategoryController::class);
    Route::post('categories/search', [CategoryController::class, 'search']);
    Route::apiResource('post', PostController::class);
    Route::post('posts/search', [PostController::class, 'search']);
    Route::apiResource('comment', CommentController::class);
    Route::post('comments/search', [CommentController::class, 'search']);

    Route::get('email/verify/{id}', [VerifyEmailController::class, 'verify'])->name('verification.verify');
    Route::get('email/resend', [VerifyEmailController::class, 'resend'])->name('verification.resend');

});
