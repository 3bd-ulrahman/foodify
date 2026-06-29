<?php

namespace Database\Factories;

use App\Models\Meal;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderItem>
 */
class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'meal_id' => Meal::factory(),
            'price_at_purchase' => fake()->randomFloat(2, 5, 50),
            'quantity' => fake()->numberBetween(1, 5),
            'created_at' => fake()->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
