<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UserRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(): JsonResponse
    {
        $users = User::paginate(Config::get('blogsettings.pagination.users'));
        return $this->apiResult(__('messages.index_method', ['name' => __('values.users')]), [
            'users' => UserResource::collection($users),
            'links' => UserResource::collection($users)->response()->getData()->links,
            'meta' => UserResource::collection($users)->response()->getData()->meta,
        ]);
    }

    public function store(UserRequest $userRequest, User $user): JsonResponse
    {
        return $this->apiResult(__('messages.store_method', ['name' => __('values.user')]),
            new UserResource($user->newUser($userRequest))
        );
    }

    public function show(User $user): JsonResponse
    {
        return $this->apiResult(__('messages.show_method', ['name' => __('values.user')]),
            new UserResource($user)
        );
    }

    public function update(UserRequest $userRequest, User $user)//: JsonResponse
    {
        return $this->apiResult(__('messages.update_method', ['name' => __('values.user')]),
            $user->updateUser($userRequest, $user->id)
        );
    }

    public function destroy(User $user)
    {
        $user->delete();
        return $this->apiResult(__('messages.destroy_method', ['name' => __('values.user')]),
        );
    }
}
