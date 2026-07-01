<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use libphonenumber\PhoneNumberUtil;
use Propaganistas\LaravelPhone\PhoneNumber;
use Propaganistas\LaravelPhone\Rules\Phone;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:10', 'max:100'],
            /**
             * The iso country code for mobile number
             *
             * @var string
             *
             * @example EG
             */
            'iso_country_code' => [
                'required',
                'string',
                'size:2',
                Rule::in(PhoneNumberUtil::getInstance()->getSupportedRegions()),
            ],
            /**
             * @var string
             *
             * @example +01023078111
             */
            'phone' => [
                'bail',
                'required',
                'string',
                (new Phone)->country([$this->iso_country_code]),
                function (string $attribute, mixed $value, \Closure $fail) {
                    $formatted = (new PhoneNumber($value, $this->iso_country_code))->formatE164();

                    $exists = DB::table('users')->where('phone', $formatted)->exists();

                    if ($exists) {
                        $fail(__('validation.unique', ['attribute' => $attribute]));
                    }
                },
            ],
            /**
             * @var string
             *
             * @example 5648Abdulrahman@
             */
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
