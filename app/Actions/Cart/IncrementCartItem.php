<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Models\CartItem;

class IncrementCartItem
{
    public function handle(CartItem $cartItem): CartItem
    {
        $cartItem->increment('quantity');

        return $cartItem;
    }
}
