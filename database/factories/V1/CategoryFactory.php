<?php

namespace Database\Factories\V1;

use App\Models\V1\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    private static $counter = 0;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->jobTitle();
        $parent_id = null;
        if (self::$counter > 5)
            $parent_id = $this->faker->numberBetween(1, 4);
        self::$counter++;
        return [
            'title' => $title,
            'slug' => str_replace(' ', '_', $title),
            'parent_id' => $parent_id
        ];
    }
}
