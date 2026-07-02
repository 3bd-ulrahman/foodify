<?php

declare(strict_types=1);

namespace App\Actions\Meal;

use App\Models\Meal;

class DeleteMeal
{
    public function handle(Meal $meal): void
    {
        $meal->delete();
    }
}
