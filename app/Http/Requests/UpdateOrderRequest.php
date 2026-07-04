<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('order')->user_id === auth()->id();
    }

    public function rules(): array
    {
        $order = $this->route('order');

        return [
            'delivery_address' => [
                'required_without:status',
                'string',
                'max:255',
                Rule::prohibitedIf(fn () => $order->status !== 'pending'),
            ],
            'status' => [
                'required_without:delivery_address',
                'string',
                'accepted_if:status,cancelled',
                function (string $attribute, mixed $value, Closure $fail) use ($order): void {
                    if ($order->status !== 'pending') {
                        $fail('Only pending orders can be cancelled, contact support.');
                    }
                },
            ],
        ];
    }
}
