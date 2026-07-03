<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Models\CartItem;

class DecrementCartItem
{
    public function handle(CartItem $cartItem): ?CartItem
    {
        if ($cartItem->quantity <= 1) {
            $cartItem->delete();

            return null;
        }

        $cartItem->decrement('quantity');

        return $cartItem;
    }
}
