<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMealRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category_id' => [
                'required',
                'integer',
                Rule::exists('categories', 'id'),
            ],
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('meals', 'name'),
            ],
            'description' => ['nullable', 'string', 'max:1000'],
            'price' => ['required', 'numeric', 'min:10', 'max:10000'],
            'energy_kcal' => ['required', 'integer', 'min:10', 'max:32767'],
            'protein_grams' => ['nullable', 'integer', 'min:10', 'max:32767'],
            'carbs_grams' => ['nullable', 'integer', 'min:10', 'max:32767'],
            'fat_grams' => ['nullable', 'integer', 'min:10', 'max:32767'],
            'fiber_grams' => ['nullable', 'integer', 'min:10', 'max:32767'],
        ];
    }
}
