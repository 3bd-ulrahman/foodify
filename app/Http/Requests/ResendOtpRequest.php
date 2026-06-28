<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use libphonenumber\PhoneNumberUtil;
use Propaganistas\LaravelPhone\Rules\Phone;

class ResendOtpRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'country_iso_code' => [
                'required',
                'string',
                'size:2',
                Rule::in(PhoneNumberUtil::getInstance()->getSupportedRegions())
            ],
            'phone' => [
                'bail',
                'required',
                'string',
                (new Phone)->country([$this->country_iso_code]),
            ]
        ];
    }
}
