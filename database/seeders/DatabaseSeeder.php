<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            MealSeeder::class,
            IngredientSeeder::class,
            ReviewSeeder::class,
            FavoriteSeeder::class,
            CartSeeder::class,
            CartItemSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
        ]);
    }
}
