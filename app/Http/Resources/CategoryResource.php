<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class CategoryResource extends JsonApiResource
{
    protected array $attributes = [
        'name',
    ];

    protected array $relationships = [
        'meals' => MealResource::class,
    ];
}
