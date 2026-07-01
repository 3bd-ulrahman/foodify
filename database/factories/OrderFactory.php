<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 10, 150);
        $deliveryFee = fake()->randomFloat(2, 2, 10);

        return [
            'user_id' => User::factory(),
            'subtotal' => $subtotal,
            'delivery_fee' => $deliveryFee,
            'total' => $subtotal + $deliveryFee,
            'delivery_address' => fake()->address(),
            'status' => fake()->randomElement(['pending', 'preparing', 'out_for_delivery', 'delivered', 'cancelled']),
        ];
    }
}
