<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class FavoriteResource extends JsonApiResource
{
    protected array $attributes = [];

    protected array $relationships = [
        'user' => UserResource::class,
        'meal' => MealResource::class,
    ];
}
