<?php

namespace App\Http\Controllers\Api;

use auth;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\OtpMail;
use App\Models\UserToken;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'first_name' => 'required|string|max:255',
    //         'last_name'  => 'required|string|max:255',
    //         'email'      => 'required|email|unique:users,email',
    //         'phone'      => 'required|string|max:12',
    //         'password'   => 'required|string|min:3',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Invalid input. Please check the information and try again.',
    //         ], 200);
    //     }

    //     try {
    //         $user = User::create([
    //             'first_name' => $request->first_name,
    //             'last_name'  => $request->last_name,
    //             'name'       => $request->first_name . ' ' . $request->last_name,
    //             'email'      => $request->email,
    //             'phone'      => $request->phone,
    //             'password'   => Hash::make($request->password),
    //             'user_role'  => 'tenant'
    //         ]);

    //         return response()->json([
    //             'status' => 'success',
    //             'userinfo' => [
    //                 'user_id' => $user->id,
    //                 'name'    => $user->name,
    //                 'email'   => $user->email,
    //                 'phone'   => $user->phone,
    //             ]
    //         ], 200);

    //     } catch (\Exception $e) {
    //         Log::error('Registration error: ' . $e->getMessage());
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Registration failed. Please try again.',
    //         ], 200);
    //     }
    // }

    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email'    => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Invalid input. Please check the information and try again.',
    //         ], 200);
    //     }

    //     $user = User::where('email', $request->email)->first();

    //     if (!$user || !Hash::check($request->password, $user->password)) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Invalid credentials'
    //         ], 200);
    //     }

    //     return response()->json([
    //         'status' => 'success',
    //         'userinfo' => [
    //             'user_id' => $user->id,
    //             'name'    => $user->name,
    //             'email'   => $user->email,
    //             'phone'   => $user->phone,
    //         ]
    //     ], 200);
    // }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'phone'      => 'required|string|max:12',
            'password'   => 'required|string|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid input. Please check the information and try again.',
                // 'errors' => $validator->errors()
            ], 200);
        }

        try {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'name'       => $request->first_name . ' ' . $request->last_name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'password'   => Hash::make($request->password),
                'user_role'  => 'tenant',
            ]);

            // Generate and store token
            $token = Str::random(64);
            $expiresAt = now()->addHours(1);

            UserToken::create([
                'user_id'    => $user->id,
                'token'      => $token,
                'expires_at' => $expiresAt,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User registered successfully.',
                'userinfo' => [
                    'user_id' => $user->id,
                    'name'    => $user->name,
                    'email'   => $user->email,
                    'phone'   => $user->phone,
                ],
                'token' => $token,
                'expires_at' => $expiresAt
            ], 200);

        } catch (Exception $e) {
            Log::error('Registration error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Registration failed. Please try again.',
            ], 200);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid input. Please check the information and try again.',
                // 'errors' => $validator->errors()
            ], 200);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials.',
            ], 200);
        }

        try {
            // Generate a new token
            $token = Str::random(64);
            $expiresAt = now()->addHours(1);

            // Delete existing tokens for the user
            UserToken::where('user_id', $user->id)->delete();

            // Store the new token
            UserToken::create([
                'user_id'    => $user->id,
                'token'      => $token,
                'expires_at' => $expiresAt,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful.',
                'userinfo' => [
                    'user_id' => $user->id,
                    'name'    => $user->name,
                    'email'   => $user->email,
                    'phone'   => $user->phone,
                ],
                'token' => $token,
                'expires_at' => $expiresAt
            ], 200);

        } catch (Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Login failed. Please try again.',
            ], 200);
        }
    }

    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'The provided email is not registered.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid input. Please check the information and try again.',
            ], 200);
        }

        try {
            $user = User::where('email', $request->email)->first();
            $plainOtp = $user->generateOtp(); // Generate and save OTP
            Mail::to($user->email)->send(new OtpMail($plainOtp));

            return response()->json([
                'status' => 'success',
                'message' => 'OTP sent to your email',
            ], 200);

        } catch (\Exception $e) {
            Log::error('OTP send error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send OTP.',
            ], 200);
        }
    }

    // public function verifyOtp(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email|exists:users,email',
    //         'otp'   => 'required|digits:6'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Invalid input. Please check the information and try again.',
    //         ], 200);
    //     }

    //     try {
    //         $user = User::where('email', $request->email)->first();

    //         if (!$user->validateOtp($request->otp)) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => 'Invalid or expired OTP'
    //             ], 200);
    //         }

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'OTP verified',
    //         ], 200);

    //     } catch (\Exception $e) {
    //         Log::error('OTP verification error: ' . $e->getMessage());

    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'OTP verification failed',
    //         ], 200);
    //     }
    // }

    // public function resetPassword(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email'       => 'required|email|exists:users,email',
    //         'new_password' => 'required|min:3',
    //         'otp'          => 'required|digits:6',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Validation failed.',
    //         ], 200);
    //     }

    //     try {
    //         $user = User::where('email', $request->email)->first();

    //         if (!$user->validateOtp($request->otp)) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => 'Invalid or expired OTP',
    //             ], 200);
    //         }

    //         $user->update([
    //             'password'    => Hash::make($request->new_password),
    //             'otp'         => null,
    //             'otp_expiry'  => null,
    //         ]);

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Password reset successfully',
    //         ], 200);

    //     } catch (\Exception $e) {
    //         Log::error('Password reset error: ' . $e->getMessage());

    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to reset password',
    //         ], 200);
    //     }
    // }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp'   => 'required|digits:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid input. Please check the information and try again.',
            ], 200);
        }

        try {
            $user = User::where('email', $request->email)->first();

            if (!$user->validateOtp($request->otp)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid or expired OTP'
                ], 200);
            }

            // Generate a temporary token for the reset password process
            $resetToken = Str::random(64);
            $expiresAt = now()->addMinutes(30);

            // Store the reset token
            UserToken::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'token' => $resetToken,
                    'expires_at' => $expiresAt
                ]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'OTP verified. Use the token for resetting the password.',
                'reset_token' => $resetToken,
                'expires_at' => $expiresAt,
            ], 200);

        } catch (\Exception $e) {
            Log::error('OTP verification error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'OTP verification failed',
            ], 200);
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reset_token' => 'required|string',
            'new_password' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
            ], 200);
        }

        try {
            $tokenData = UserToken::where('token', $request->reset_token)
                                ->where('expires_at', '>', now())
                                ->first();

            if (!$tokenData) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid or expired reset token',
                ], 200);
            }

            $user = User::find($tokenData->user_id);

            // Update the user's password and clear the OTP and token data
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            // Delete the token after successful password reset
            $tokenData->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Password reset successfully',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Password reset error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to reset password',
            ], 200);
        }
    }

}
