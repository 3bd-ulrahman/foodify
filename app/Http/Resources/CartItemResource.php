<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class CartItemResource extends JsonApiResource
{
    protected array $attributes = [
        'quantity',
    ];

    protected array $relationships = [
        'meal' => MealResource::class,
        'cart' => CartResource::class,
    ];
}
