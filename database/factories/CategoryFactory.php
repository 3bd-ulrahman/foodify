<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    protected static ?array $categoryNames = [
        'Appetizers',
        'Main Courses',
        'Salads',
        'Soups',
        'Desserts',
        'Beverages',
        'Sandwiches',
        'Pasta',
        'Pizza',
        'Seafood',
        'Grill',
        'Vegetarian',
        'Vegan',
        'Breakfast',
        'Sides',
    ];

    protected static int $index = 0;

    public function definition(): array
    {
        $name = static::$categoryNames[static::$index % count(static::$categoryNames)];
        static::$index++;

        return [
            'name' => $name,
        ];
    }
}
