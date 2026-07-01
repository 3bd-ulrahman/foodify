<?php

namespace Database\Factories;

use App\Models\Meal;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'meal_id' => Meal::factory(),
            'user_id' => User::factory(),
            'rating' => fake()->numberBetween(1, 5),
            'comment' => fake()->optional(0.7)->sentence(),
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
