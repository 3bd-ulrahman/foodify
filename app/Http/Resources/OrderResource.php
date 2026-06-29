<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class OrderResource extends JsonApiResource
{
    protected array $attributes = [
        'subtotal',
        'delivery_fee',
        'total',
        'delivery_address',
        'status',
    ];

    protected array $relationships = [
        'user' => UserResource::class,
        'items' => OrderItemResource::class,
    ];
}
