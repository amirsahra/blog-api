<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CommentRequest;
use App\Http\Requests\V1\PostRequest;
use App\Http\Resources\V1\CommentResource;
use App\Http\Resources\V1\PostResource;
use App\Models\V1\Comment;
use App\Models\V1\Post;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class CommentController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('auth:api')->only('store');
        $this->middleware('author')->only(['update','destroy']);
    }

    public function index(): JsonResponse
    {
        $comments = Comment::where('parent_id', null)->with('children')
            ->paginate(Config::get('blogsettings.pagination.comment'));
        return $this->apiResult(__('messages.index_method', ['name' => __('values.comment')]), [
            'comments' => CommentResource::collection($comments),
            'links' => CommentResource::collection($comments)->response()->getData()->links,
            'meta' => CommentResource::collection($comments)->response()->getData()->meta,
        ]);
    }

    public function store(CommentRequest $commentRequest, Comment $comment): JsonResponse
    {
        return $this->apiResult(__('messages.store_method', ['name' => __('values.comment')]),
            new CommentResource($comment->newComment($commentRequest))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
