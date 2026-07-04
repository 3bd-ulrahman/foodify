<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Order\CreateOrder;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Support\Pagination;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $request->validate([
            'per_page' => [Pagination::PER_PAGE_RULES],
        ]);

        $orders = Order::query()->where('user_id', auth()->id())
            ->paginate($request->integer('per_page', Pagination::DEFAULT_PER_PAGE));

        return OrderResource::collection($orders);
    }

    public function store(StoreOrderRequest $request, CreateOrder $action): JsonResponse
    {
        $order = $action->handle($request->validated(), auth()->user());

        return OrderResource::make($order)
            ->additional([
                'meta' => [
                    'message' => 'Order placed successfully.',
                ],
            ])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
