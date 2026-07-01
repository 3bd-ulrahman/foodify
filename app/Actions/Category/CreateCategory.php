<?php

namespace App\Actions\Category;

use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CreateCategory
{
    public function handle(array $data): Category
    {
        $category = Category::query()->create($data);

        return $category;
    }
}
