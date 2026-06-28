<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone' => ['required', 'exists:users,phone']
        ];
    }
}
