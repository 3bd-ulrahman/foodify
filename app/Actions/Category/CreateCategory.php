<?php

declare(strict_types=1);

namespace App\Actions\Category;

use App\Models\Category;

class CreateCategory
{
    public function handle(array $data): Category
    {
        $category = Category::query()->create($data);

        return $category;
    }
}
