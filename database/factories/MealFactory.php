<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Meal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Meal>
 */
class MealFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->word().' '.fake()->word().' '.fake()->numberBetween(100, 999),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 5, 50),
            'energy_kcal' => fake()->numberBetween(200, 800),
            'protein_grams' => fake()->optional()->numberBetween(5, 50),
            'carbs_grams' => fake()->optional()->numberBetween(10, 100),
            'fat_grams' => fake()->optional()->numberBetween(5, 40),
            'fiber_grams' => fake()->optional()->numberBetween(1, 20),
            'category_id' => Category::inRandomOrder()->value('id'),
        ];
    }
}
