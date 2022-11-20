<?php

namespace App\Models\V1;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'slug', 'author_id', 'cat_id'];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
