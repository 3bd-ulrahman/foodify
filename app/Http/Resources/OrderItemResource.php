<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class OrderItemResource extends JsonApiResource
{
    protected array $attributes = [
        'price_at_purchase',
        'quantity',
    ];

    protected array $relationships = [
        'meal' => MealResource::class,
        'order' => OrderResource::class,
    ];
}
