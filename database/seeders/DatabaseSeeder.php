<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\V1\Category;
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
    }
}
