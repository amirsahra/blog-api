<?php

namespace Database\Factories\V1;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'slug' => $this->faker->unique()->slug(),
            'content' => $this->faker->realTextBetween(),
            'author_id' => $this->faker->numberBetween(1, 10),
            'cat_id' => $this->faker->numberBetween(1, 30),
            'status' => $this->faker->randomElement(['publish', 'draft', 'ban']),
        ];
    }
}
