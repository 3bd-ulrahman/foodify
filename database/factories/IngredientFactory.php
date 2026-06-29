<?php

namespace Database\Factories;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ingredient>
 */
class IngredientFactory extends Factory
{
    protected static ?array $ingredientNames = [
        'Olive Oil', 'Garlic', 'Onion', 'Tomato', 'Chicken Breast',
        'Beef', 'Salmon', 'Rice', 'Pasta', 'Potato',
        'Carrot', 'Broccoli', 'Spinach', 'Bell Pepper', 'Mushroom',
        'Cheese', 'Butter', 'Eggs', 'Flour', 'Sugar',
        'Salt', 'Black Pepper', 'Paprika', 'Cumin', 'Turmeric',
        'Lemon', 'Lime', 'Basil', 'Oregano', 'Thyme',
        'Rosemary', 'Cilantro', 'Parsley', 'Mint', 'Ginger',
        'Soy Sauce', 'Vinegar', 'Honey', 'Milk', 'Cream',
    ];

    protected static int $index = 0;

    public function definition(): array
    {
        $name = static::$ingredientNames[static::$index % count(static::$ingredientNames)];
        static::$index++;

        return [
            'name' => $name,
            'icon' => fake()->randomElement(['🥩', '🥦', '🧅', '🧄', '🍅', '🥕', '🧀', '🥚', '🍋', '🌿']),
        ];
    }
}
