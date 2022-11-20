<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\PostRequest;
use App\Http\Resources\V1\PostCompleteInfo;
use App\Http\Resources\V1\PostResource;
use App\Models\V1\Post;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

class PostController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('auth:api')->only('store');
    }

    public function index(): JsonResponse
    {
        $post = Post::paginate(Config::get('blogsettings.pagination.post'));
        return $this->apiResult(__('messages.index_method', ['name' => __('values.post')]), [
            'posts' => PostResource::collection($post),
            'links' => PostResource::collection($post)->response()->getData()->links,
            'meta' => PostResource::collection($post)->response()->getData()->meta,
        ]);
    }

    public function store(PostRequest $postRequest, Post $post): JsonResponse
    {
        return $this->apiResult(__('messages.store_method', ['name' => __('values.user')]),
            new PostResource($post->newPost($postRequest))
        );
    }

    public function show(Post $post): JsonResponse
    {
        return $this->apiResult(__('messages.show_method', ['name' => __('values.post')]),
            new PostCompleteInfo($post)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
