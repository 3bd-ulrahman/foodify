<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Models\Cart;
use App\Models\CartItem;

class ClearCart
{
    public function handle(Cart $cart): void
    {
        CartItem::query()
            ->where('cart_id', $cart->id)
            ->delete();
    }
}
