<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class MealResource extends JsonApiResource
{
    protected array $attributes = [
        'name',
        'description',
        'price',
        'energy_kcal',
        'protein_grams',
        'carbs_grams',
        'fat_grams',
        'fiber_grams',
    ];

    protected array $relationships = [
        'category' => CategoryResource::class,
        'ingredients' => IngredientResource::class,
        'reviews' => ReviewResource::class,
        'favorites' => FavoriteResource::class,
    ];
}
