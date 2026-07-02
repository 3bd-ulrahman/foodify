<?php

declare(strict_types=1);

namespace App\Actions\Meal;

use App\Models\Meal;

class UpdateMeal
{
    public function handle(Meal $meal, array $data): Meal
    {
        $meal->update($data);

        return $meal;
    }
}
