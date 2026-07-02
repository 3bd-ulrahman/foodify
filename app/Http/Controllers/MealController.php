<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Meal\CreateMeal;
use App\Actions\Meal\DeleteMeal;
use App\Actions\Meal\UpdateMeal;
use App\Http\Requests\StoreMealRequest;
use App\Http\Requests\UpdateMealRequest;
use App\Http\Resources\MealResource;
use App\Models\Meal;
use App\Support\Pagination;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\JsonApi\JsonApiResource;
use Symfony\Component\HttpFoundation\Response;

class MealController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $request->validate([
            'per_page' => [Pagination::PER_PAGE_RULES],
        ]);

        $meals = Meal::query()->paginate($request->integer('per_page', Pagination::DEFAULT_PER_PAGE));

        return MealResource::collection($meals);
    }

    public function store(StoreMealRequest $request, CreateMeal $action): JsonResponse
    {
        $meal = $action->handle($request->validated());

        return MealResource::make($meal)
            ->additional([
                'meta' => [
                    'message' => 'Meal created successfully.',
                ],
            ])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Meal $meal): JsonApiResource
    {
        return MealResource::make($meal);
    }

    public function update(UpdateMealRequest $request, Meal $meal, UpdateMeal $action): JsonResponse
    {
        $meal = $action->handle($meal, $request->validated());

        return MealResource::make($meal)
            ->additional([
                'meta' => [
                    'message' => 'Meal updated successfully.',
                ],
            ])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(Meal $meal, DeleteMeal $action): Response
    {
        $action->handle($meal);

        return response()->noContent();
    }
}
