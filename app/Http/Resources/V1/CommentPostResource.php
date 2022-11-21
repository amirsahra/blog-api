<?php

namespace App\Http\Resources\V1;

use App\Models\User;
use App\Models\V1\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'children' => CommentChildrenResource::collection($this->whenLoaded('children'))
        ];
    }
}
