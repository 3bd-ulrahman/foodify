<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class UserResource extends JsonApiResource
{
    protected array $attributes = [
        'name',
        'phone',
    ];

    protected array $relationships = [
        'reviews' => ReviewResource::class,
        'favorites' => FavoriteResource::class,
        'cart' => CartResource::class,
        'orders' => OrderResource::class,
    ];
}
