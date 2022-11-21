<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\V1\Category;
use App\Models\V1\Comment;
use App\Models\V1\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        $this->call(DefaultAdminSeeder::class);
        Category::factory(30)->create();
        Post::factory(50)->create();
        Comment::factory(100)->create();
    }
}
