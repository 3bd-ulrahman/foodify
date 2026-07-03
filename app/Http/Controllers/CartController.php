<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Cart\ClearCart;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function clear(Cart $cart, ClearCart $action): JsonResponse
    {
        $action->handle($cart);

        return CartResource::make($cart)
            ->additional([
                'meta' => [
                    'message' => 'Cart cleared successfully.',
                ],
            ])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
