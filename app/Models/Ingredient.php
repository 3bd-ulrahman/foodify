<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\IngredientFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[UseFactory(IngredientFactory::class)]
class Ingredient extends Model
{
    use HasFactory;

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
