<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Models\CartItem;

class DeleteCartItem
{
    public function handle(CartItem $cartItem): void
    {
        $cartItem->delete();
    }
}
