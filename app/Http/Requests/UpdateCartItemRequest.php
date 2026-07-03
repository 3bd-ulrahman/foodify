<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCartItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'meal_id' => [
                'required',
                'integer',
                Rule::exists('meals', 'id'),
            ],
            'quantity' => ['required', 'integer', 'min:1', 'max:10'],
        ];
    }
}
