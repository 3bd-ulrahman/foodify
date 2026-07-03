<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Models\CartItem;
use App\Models\User;

class CreateCartItem
{
    public function handle(array $data, User $user): CartItem
    {
        $cartItem = $user->cart->items()->create([
            'meal_id' => $data['meal_id'],
            'quantity' => 1,
        ]);

        return $cartItem;
    }
}
