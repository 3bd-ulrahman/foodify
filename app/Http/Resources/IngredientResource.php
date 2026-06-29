<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class IngredientResource extends JsonApiResource
{
    protected array $attributes = [
        'name',
        'icon',
    ];

    protected array $relationships = [
        'meals' => MealResource::class,
    ];
}
