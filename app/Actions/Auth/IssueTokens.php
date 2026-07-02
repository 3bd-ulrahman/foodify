<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Support\TokenAbility;

class IssueTokens
{
    public function handle(User $user): array
    {
        $accessToken = $user->createToken(
            'access',
            [TokenAbility::ACCESS_API->value],
            expiresAt: now()->addMinutes(config('sanctum.expiration', 60))
        );

        $refreshToken = $user->createToken(
            'refresh',
            [TokenAbility::ISSUE_ACCESS_TOKEN->value],
            expiresAt: now()->addDays(config('sanctum.refresh_token_expiration', 7))
        );

        return [
            'access_token' => $accessToken->plainTextToken,
            'refresh_token' => $refreshToken->plainTextToken,
        ];
    }
}
