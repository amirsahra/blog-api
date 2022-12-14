<?php

namespace App\Http\Resources\V1;

use App\Models\User;
use App\Models\V1\Category;
use App\Models\V1\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCompleteInfo extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $comment = Comment::where('post_id', '=', $this->id)->with('children')->get();
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'author' => new UserResource(User::find($this->author_id)),
            'category' => new CategoryResource(Category::find($this->cat_id)),
            'comments' => CommentPostResource::collection($comment),
        ];
    }
}
