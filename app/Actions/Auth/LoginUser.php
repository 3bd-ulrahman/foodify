<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginUser
{
    /**
     * @return array{user: User, token: string}
     */
    public function handle(array $data): array
    {
        $user = User::query()->where('phone', $data['phone'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages(['phone' => __('auth.failed')]);
        }

        if (! $user->phone_verified_at) {
            throw ValidationException::withMessages(['phone' => __('auth.unverified')]);
        }

        return [
            'user' => $user,
            'tokens' => (app(IssueTokens::class)->handle($user)),
        ];
    }
}
