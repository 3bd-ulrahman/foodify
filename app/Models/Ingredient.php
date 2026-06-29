<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    protected $table = 'ingredients';

    protected $fillable = [
        'name',
        'icon',
    ];

    // Relationships
    public function meals(): BelongsToMany
    {
        return $this->belongsToMany(Meal::class, 'ingredient_meal', 'ingredient_id', 'meal_id');
    }
}
