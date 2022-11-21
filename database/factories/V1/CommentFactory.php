<?php

namespace Database\Factories\V1;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    private static $counter = 0;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $parent_id = null;
        if (self::$counter > 5)
            $parent_id = $this->faker->numberBetween(1, 4);
        if (self::$counter > 20)
            $parent_id = $this->faker->numberBetween(8, 15);
        self::$counter++;
        return [
            'title' => $this->faker->title(),
            'content' => $this->faker->realTextBetween(50, 100),
            'parent_id' => $parent_id,
            'post_id' => $this->faker->numberBetween(1,50),
            'author_id' => $this->faker->numberBetween(1,11),
        ];
    }
}
