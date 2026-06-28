<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Tawhub\Laravel\Facades\Tawhub;

class SendOtp
{
    /**
     * @param  'registration'|'password_reset'  $purpose
     */
    public function handle(string $phone, string $purpose): void
    {
        // FIXME: fix in production
        // $otp = (string) random_int(100000, 999999);
        $otp = '123456';

        defer(function () use ($phone, $otp) {
            Tawhub::send_text(ltrim($phone, '+'), 'Welcome to city view, your OTP is: ' . $otp);
        });

        Cache::put("{$purpose}_otp_{$phone}", [
            'otp' => Hash::make($otp),
            'attempts' => 0,
            'expires_at' => now()->addMinutes(5)
        ], now()->addMinutes(5));
    }
}
