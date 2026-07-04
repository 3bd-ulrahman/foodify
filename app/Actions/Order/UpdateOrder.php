<?php

declare(strict_types=1);

namespace App\Actions\Order;

use App\Models\Order;

class UpdateOrder
{
    public function handle(array $data, Order $order): Order
    {
        $order->update($data);

        return $order->load('items');
    }
}
