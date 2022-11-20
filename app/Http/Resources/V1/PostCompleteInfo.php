<?php

namespace App\Http\Resources\V1;

use App\Models\User;
use App\Models\V1\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCompleteInfo extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title'=>$this->title,
            'slug'=>$this->slug,
            'content'=>$this->content,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'author'=> new UserResource(User::find($this->author_id)),
            'category'=> new CategoryResource(Category::find($this->cat_id)),
            //TODO all comment
        ];
    }
}
