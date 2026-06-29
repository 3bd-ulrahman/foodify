<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    const UPDATED_AT = null;

    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'meal_id',
        'price_at_purchase',
        'quantity',
    ];

    // Relationships
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function meal(): BelongsTo
    {
        return $this->belongsTo(Meal::class, 'meal_id', 'id');
    }
}
