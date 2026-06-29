<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class VerifyOtp
{
    /**
     * @param  'registration'|'password_reset'  $purpose
     * @return array{user?: User, token?: string, reset_token?: string}
     */
    public function handle(string $phone, string $otp, string $purpose): array
    {
        $key = "{$purpose}_otp_{$phone}";
        $cached = Cache::get($key);

        if (! $cached) {
            throw ValidationException::withMessages(['otp' => 'OTP expired or invalid.']);
        }

        if ($cached['attempts'] >= 3) {
            Cache::forget($key);

            throw ValidationException::withMessages(['otp' => 'Too many attempts.']);
        }

        if (! Hash::check($otp, $cached['otp'])) {
            $cached['attempts']++;
            Cache::put($key, $cached, $cached['expires_at']);

            throw ValidationException::withMessages(['otp' => 'Invalid OTP.']);
        }

        Cache::forget($key);

        if ($purpose === 'registration') {
            return $this->handleRegistrationVerification($phone);
        }

        return $this->handlePasswordResetVerification($phone);
    }

    /**
     * @return array{user: User, token: string}
     */
    private function handleRegistrationVerification(string $phone): array
    {
        $user = User::query()->where('phone', $phone)->firstOrFail();

        $user->forceFill([
            'phone_verified_at' => now()
        ])->save();

        $accessToken = $user->createToken($user->phone);

        return [
            'user' => $user,
            'token' => $accessToken->plainTextToken
        ];
    }

    /**
     * @return array{reset_token: string}
     */
    private function handlePasswordResetVerification(string $phone): array
    {
        $resetToken = Str::random(40);

        Cache::put(
            "password_reset_token_{$phone}",
            Hash::make($resetToken),
            now()->addMinutes(5)
        );

        return ['reset_token' => $resetToken];
    }
}
