<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Models\CartItem;

class UpdateCartItem
{
    public function handle(array $data, CartItem $cartItem): CartItem
    {
        $cartItem->update([
            'quantity' => $data['quantity'],
        ]);

        return $cartItem;
    }
}
