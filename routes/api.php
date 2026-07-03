<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MealController;
use App\Support\TokenAbility;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('refresh', [AuthController::class, 'refresh'])->middleware([
    'auth:sanctum',
    'ability:'.TokenAbility::ISSUE_ACCESS_TOKEN->value,
]);
Route::delete('logout', [AuthController::class, 'logout'])->middleware([
    'auth:sanctum',
    'ability:'.TokenAbility::ACCESS_API->value,
]);
Route::post('forgot-password', [AuthController::class, 'forgotPassword'])
    ->name('password.forgot')
    ->middleware(['throttle:3,1', 'guest']);
Route::post('verify-otp', [AuthController::class, 'verifyOtp'])->name('password.verify');
Route::post('resend-otp', [AuthController::class, 'resendOtp'])
    ->name('otp.resend')
    ->middleware(['throttle:3,1', 'guest']);
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');

// categories
Route::apiResource('categories', CategoryController::class);

// products
Route::apiResource('meals', MealController::class);

Route::middleware(['auth:sanctum', 'ability:'. TokenAbility::ACCESS_API->value])->group(function () {
    // cart items
    Route::apiResource('cart-items', CartItemController::class)->except('show');
    Route::post('cart-items/{cart_item}/increment', [CartItemController::class, 'increment']);
    Route::post('cart-items/{cart_item}/decrement', [CartItemController::class, 'decrement']);

    // cart
    Route::delete('carts/{cart}/clear', [CartController::class, 'clear']);
});
