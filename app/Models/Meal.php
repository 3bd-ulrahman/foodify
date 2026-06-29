<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meal extends Model
{
    protected $table = 'meals';

    protected $fillable = [
        'name',
        'description',
        'price',
        'energy_kcal',
        'protein_grams',
        'carbs_grams',
        'fat_grams',
        'fiber_grams',
        'category_id',
    ];

    // Relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_meal', 'meal_id', 'ingredient_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'meal_id', 'id');
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class, 'meal_id', 'id');
    }

    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class, 'cart_items', 'meal_id', 'cart_id');
    }
}
