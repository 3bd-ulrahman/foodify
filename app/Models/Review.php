<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    const UPDATED_AT = null;

    protected $table = 'reviews';

    protected $fillable = [
        'meal_id',
        'user_id',
        'rating',
        'comment',
    ];

    // Relationships
    public function meal(): BelongsTo
    {
        return $this->belongsTo(Meal::class, 'meal_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
