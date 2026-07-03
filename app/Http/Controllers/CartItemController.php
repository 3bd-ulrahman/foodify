<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Cart\CreateCartItem;
use App\Actions\Cart\DecrementCartItem;
use App\Actions\Cart\DeleteCartItem;
use App\Actions\Cart\IncrementCartItem;
use App\Actions\Cart\UpdateCartItem;
use App\Http\Requests\StoreCartItemRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
use App\Support\Pagination;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\JsonApi\JsonApiResource;
use Symfony\Component\HttpFoundation\Response;

class CartItemController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $request->validate([
            'per_page' => [Pagination::PER_PAGE_RULES],
        ]);

        $cartItems = CartItem::query()->paginate($request->integer('per_page', Pagination::DEFAULT_PER_PAGE));

        return CartItemResource::collection($cartItems);
    }

    public function store(StoreCartItemRequest $request, CreateCartItem $action): JsonResponse
    {
        $cartItem = $action->handle($request->validated());

        return CartItemResource::make($cartItem)
            ->additional([
                'meta' => [
                    'message' => 'Cart item created successfully.',
                ],
            ])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CartItem $cartItem): JsonApiResource
    {
        return CartItemResource::make($cartItem);
    }

    public function update(UpdateCartItemRequest $request, CartItem $cartItem, UpdateCartItem $action): JsonResponse
    {
        $cartItem = $action->handle($cartItem, $request->validated());

        return CartItemResource::make($cartItem)
            ->additional([
                'meta' => [
                    'message' => 'Cart item updated successfully.',
                ],
            ])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(CartItem $cartItem, DeleteCartItem $action): Response
    {
        $action->handle($cartItem);

        return response()->noContent();
    }

    public function increment(CartItem $cartItem, IncrementCartItem $action): JsonResponse
    {
        $cartItem = $action->handle($cartItem);

        return CartItemResource::make($cartItem)
            ->additional([
                'meta' => [
                    'message' => 'Cart item quantity incremented successfully.',
                ],
            ])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function decrement(CartItem $cartItem, DecrementCartItem $action): JsonResponse
    {
        $cartItem = $action->handle($cartItem);

        if ($cartItem === null) {
            return response()->json([
                'data' => null,
                'meta' => [
                    'message' => 'Cart item removed successfully.',
                ],
            ], Response::HTTP_OK);
        }

        return CartItemResource::make($cartItem)
            ->additional([
                'meta' => [
                    'message' => 'Cart item quantity decremented successfully.',
                ],
            ])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
