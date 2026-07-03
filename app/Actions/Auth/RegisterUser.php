<?php

namespace App\Actions\Auth;

use App\Models\User;
use Propaganistas\LaravelPhone\PhoneNumber;

class RegisterUser
{
    public function __construct(private SendOtp $sendOtp) {}

    public function handle(array $data): User
    {
        $phone = (new PhoneNumber($data['phone'], $data['iso_country_code']))->formatE164();

        $user = User::query()->create([
            'name' => $data['name'],
            'phone' => $phone,
            'password' => $data['password'],
        ]);

        $user->cart()->create();

        $this->sendOtp->handle($phone, 'registration');

        return $user;
    }
}
