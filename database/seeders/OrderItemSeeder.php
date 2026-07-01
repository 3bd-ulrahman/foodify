<?php

namespace Database\Seeders;

use App\Models\Meal;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $meals = Meal::all();

        Order::all()->each(function (Order $order) use ($meals): void {
            $orderMeals = $meals->random(fake()->numberBetween(1, 5));

            $orderMeals->each(function (Meal $meal) use ($order): void {
                OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'meal_id' => $meal->id,
                    'price_at_purchase' => $meal->price,
                ]);
            });
        });
    }
}
