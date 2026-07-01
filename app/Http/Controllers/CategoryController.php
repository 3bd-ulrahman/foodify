<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Category\DeleteCategory;
use App\Actions\Category\CreateCategory;
use App\Actions\Category\UpdateCategory;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Support\Pagination;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'per_page' => [Pagination::PER_PAGE_RULES]
        ]);

        $categories = Category::query()->paginate($request->integer('per_page', Pagination::DEFAULT_PER_PAGE));

        return response()->success(CategoryResource::collection($categories));
    }

    public function store(StoreCategoryRequest $request, CreateCategory $action): JsonResponse
    {
        $category = $action->handle($request->validated());

        return response()->created(
            'Category created successfully',
            new CategoryResource($category)
        );
    }

    public function show(Category $category): JsonResponse
    {
        return response()->success(new CategoryResource($category));
    }

    public function update(UpdateCategoryRequest $request, Category $category, UpdateCategory $action): JsonResponse
    {
        $category = $action->handle($category, $request->validated());

        return response()->success(
            new CategoryResource($category),
            'Category updated successfully'
        );
    }

    public function destroy(Category $category, DeleteCategory $action): Response
    {
        $action->handle($category);

        return response()->noContent();
    }
}
