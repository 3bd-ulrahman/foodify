<?php

declare(strict_types=1);

namespace App\Actions\Meal;

use App\Models\Meal;

class CreateMeal
{
    public function handle(array $data): Meal
    {
        $meal = Meal::query()->create($data);

        return $meal;
    }
}
