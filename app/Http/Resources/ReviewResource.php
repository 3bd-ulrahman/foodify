<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class ReviewResource extends JsonApiResource
{
    protected array $attributes = [
        'rating',
        'comment',
    ];

    protected array $relationships = [
        'meal' => MealResource::class,
        'user' => UserResource::class,
    ];
}
