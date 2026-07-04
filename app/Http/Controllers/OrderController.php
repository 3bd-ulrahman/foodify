<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Support\Pagination;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
}
