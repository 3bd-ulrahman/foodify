<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Meal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $ingredients = Ingredient::factory(20)->create();

        Meal::all()->each(function (Meal $meal) use ($ingredients): void {
            $meal->ingredients()->attach(
                $ingredients->random(fake()->numberBetween(3, 8))->pluck('id')
            );
        });
    }
}
