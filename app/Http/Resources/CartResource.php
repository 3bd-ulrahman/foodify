<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class CartResource extends JsonApiResource
{
    protected array $attributes = [];

    protected array $relationships = [
        'user' => UserResource::class,
        'items' => CartItemResource::class,
        'meals' => MealResource::class,
    ];
}
