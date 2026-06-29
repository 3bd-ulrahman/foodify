<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Meal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $meals = Meal::all();

        Cart::all()->each(function (Cart $cart) use ($meals): void {
            $cartMeals = $meals->random(fake()->numberBetween(1, 4));

            $cartMeals->each(function (Meal $meal) use ($cart): void {
                CartItem::factory()->create([
                    'cart_id' => $cart->id,
                    'meal_id' => $meal->id,
                ]);
            });
        });
    }
}
