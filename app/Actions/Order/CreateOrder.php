<?php

declare(strict_types=1);

namespace App\Actions\Order;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateOrder
{
    public function handle(array $data, User $user): Order
    {
        return DB::transaction(function () use ($data, $user) {
            $cart = $user->cart()->firstOrFail();

            $cartItems = CartItem::query()
                ->where('cart_id', $cart->id)
                ->with('meal')
                ->get();

            $subtotal = $cartItems->sum(fn (CartItem $item) => $item->meal->price * $item->quantity);

            $deliveryFee = 5.00;

            $order = Order::query()->create([
                'user_id' => $user->id,
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'total' => $subtotal + $deliveryFee,
                'delivery_address' => $data['delivery_address'],
                'status' => 'pending',
            ]);

            $orderItems = $cartItems->map(fn (CartItem $item) => [
                'order_id' => $order->id,
                'meal_id' => $item->meal_id,
                'price_at_purchase' => $item->meal->price,
                'quantity' => $item->quantity,
            ]);

            $order->items()->createMany($orderItems->toArray());

            $cart->items()->delete();

            return $order->load('items');
        });
    }
}
