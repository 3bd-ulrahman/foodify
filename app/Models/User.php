<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[UseFactory(UserFactory::class)]
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'phone',
        'password',
    ];

    protected $hiddent = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'phone_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'user_id', 'id');
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class, 'user_id', 'id');
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class, 'user_id', 'id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }
}
