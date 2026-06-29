<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];

    // Relationships
    public function meals(): HasMany
    {
        return $this->hasMany(Meal::class, 'category_id', 'id');
    }
}
