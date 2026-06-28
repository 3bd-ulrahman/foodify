<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Propaganistas\LaravelPhone\PhoneNumber;

class ResendOtp
{
    public function __construct(private SendOtp $sendOtp) {}

    public function handle(string $phone, string $countryIsoCode): void
    {
        $formattedPhone = (new PhoneNumber($phone, $countryIsoCode))->formatE164();

        $user = User::query()->where('phone', $formattedPhone)->first();

        if (! $user) {
            throw ValidationException::withMessages(['phone' => __('auth.not_found')]);
        }

        if ($user->phone_verified_at) {
            throw ValidationException::withMessages(['phone' => __('auth.already_verified')]);
        }

        $this->sendOtp->handle($formattedPhone, 'registration');
    }
}
