<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Models\CartItem;

class CreateCartItem
{
    public function handle(array $data): CartItem
    {
        $cartItem = CartItem::query()->create($data);

        return $cartItem;
    }
}
