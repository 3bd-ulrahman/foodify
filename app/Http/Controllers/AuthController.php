<?php

namespace App\Http\Controllers;

use App\Actions\Auth\LoginUser;
use App\Actions\Auth\RegisterUser;
use App\Actions\Auth\ResendOtp;
use App\Actions\Auth\ResetPassword;
use App\Actions\Auth\SendOtp;
use App\Actions\Auth\VerifyOtp;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResendOtpRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\VerifyOtpRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterUser $action): JsonResponse
    {
        $user = $action->handle($request->validated());

        return response()->created('Registration successful. Please verify your phone with the OTP sent.', [
            'user' => $user,
        ]);
    }

    public function login(LoginRequest $request, LoginUser $action): JsonResponse
    {
        $result = $action->handle($request->validated());

        return \Illuminate\Http\Response::success($result, 'Logged in successfully');
    }

    public function logout(): JsonResponse
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'You have successfully been logged out',
        ], Response::HTTP_OK);
    }

    public function forgotPassword(ForgotPasswordRequest $request, SendOtp $action): JsonResponse
    {
        $action->handle($request->phone, 'password_reset');

        return response()->json(['message' => 'OTP sent successfully']);
    }

    public function verifyOtp(VerifyOtpRequest $request, VerifyOtp $action): JsonResponse
    {
        $result = $action->handle(
            $request->phone,
            $request->otp,
            $request->purpose,
        );

        return response()->success($result, 'OTP verified');
    }

    public function resendOtp(ResendOtpRequest $request, ResendOtp $action): JsonResponse
    {
        $action->handle($request->phone, $request->iso_country_code);

        return response()->json(['message' => __('auth.otp_resent')]);
    }

    public function resetPassword(ResetPasswordRequest $request, ResetPassword $action): JsonResponse
    {
        $result = $action->handle($request->validated());

        return response()->success('Password reset successful', $result);
    }
}
