<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\PostRequest;
use App\Http\Resources\V1\PostCompleteInfo;
use App\Http\Resources\V1\PostResource;
use App\Models\V1\Post;
use App\Traits\ApiResponse;
use App\Traits\Searchable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PostController extends Controller
{
    use ApiResponse,Searchable;

    public function __construct()
    {
        $this->middleware('auth:api')->only('store');
        $this->middleware('post.author')->only(['update','destroy']);
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
        return $this->apiResult(__('messages.store_method', ['name' => __('values.post')]),
            new PostResource($post->newPost($postRequest))
        );
    }

    public function show(Post $post): JsonResponse
    {
        return $this->apiResult(__('messages.show_method', ['name' => __('values.post')]),
            new PostCompleteInfo($post)
        );
    }

    public function update(PostRequest $postRequest, Post $post): JsonResponse
    {
        return $this->apiResult(__('messages.update_method', ['name' => __('values.post')]),
            $post->update($postRequest->only('title', 'slug', 'content', 'status', 'cat_id'))
        );
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return $this->apiResult(__('messages.destroy_method', ['name' => __('values.post')]));
    }

    public function search(Request $request)
    {
        $model = new Post();
        $result = $this->multiSearch($model, $request->only('title','slug'),
            $request->only('author_id','status','cat_id'));
        return $this->apiResult(__('messages.search_method'),
            PostResource::collection($result));
    }

}


