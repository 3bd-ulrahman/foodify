<?php

declare(strict_types=1);

namespace App\Actions\Category;

use App\Models\Category;

class DeleteCategory
{
    public function handle(Category $category): void
    {
        $category->delete();
    }
}
