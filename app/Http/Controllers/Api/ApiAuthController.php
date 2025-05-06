<?php

namespace App\Http\Controllers\Api;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
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
            ], 200); // Force 200 on validation error
        }

        try {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'name'       => $request->first_name . ' ' . $request->last_name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'password'   => Hash::make($request->password),
                'user_role'  => 'tenant'
            ]);

            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'userinfo' => [
                    'user_id' => $user->id,
                    'name'    => $user->name,
                    'email'   => $user->email,
                    'phone'   => $user->phone,
                    'token'   => $token
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Registration error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Registration failed. Please try again.',
                // 'error' => $e->getMessage()
            ], 200);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid input. Please check the information and try again.',
                // 'errors' => $validator->errors()
            ], 200); // Force 200 for validation errors
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 200); // Force 200 for invalid login
        }

        $user = Auth::user();
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'userinfo' => [
                'user_id' => $user->id,
                'name'    => $user->name,
                'email'   => $user->email,
                'phone'   => $user->phone,
                'token'   => $token
            ]
        ], 200); // Explicitly returning 200 for consistency
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
                // 'errors' => $validator->errors()
            ], 200); // Force 200 on validation error
        }

        try {
            $user = User::where('email', $request->email)->firstOrFail();

            // Generate OTP and retrieve the plain OTP
            $plainOtp = $user->generateOtp(); // This method should return the OTP

            Mail::to($user->email)->send(new OtpMail($plainOtp));

            Log::info("OTP sent to {$user->email}");

            return response()->json([
                'status' => 'success',
                'message' => 'OTP sent to your email',
                'data' => [
                    'otp_expiry' => $user->otp_expiry->format('Y-m-d H:i:s')
                ]
            ], 200); // Explicitly 200 on success

        } catch (\Exception $e) {
            Log::error('OTP send error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send OTP. Please try again.',
                // 'error' => $e->getMessage() // You can hide this in production
            ], 200); // Force 200 on exception
        }
    }

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
                // 'errors' => $validator->errors()
            ], 200); // Force 200 on validation failure
        }

        try {
            $user = User::where('email', $request->email)->firstOrFail();

            if (!$user->validateOtp($request->otp)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid or expired OTP'
                ], 200); // 200 for OTP mismatch
            }

            $otpExpiry = $user->otp_expiry;
            $otpToken = $user->otp_token;

            // $user->clearOtp(); // Uncomment if needed

            return response()->json([
                'status' => 'success',
                'message' => 'OTP verified',
                'data' => [
                    'reset_token' => $otpToken,
                    'token_expiry' => $otpExpiry ? $otpExpiry->format('Y-m-d H:i:s') : null
                ]
            ], 200); // Explicitly 200 on success

        } catch (\Exception $e) {
            Log::error('OTP verification error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'OTP verification failed',
                'error' => $e->getMessage() // optional: remove in production
            ], 200); // Force 200 on exception
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reset_token'  => 'required',
            'new_password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 200); // Force HTTP 200
        }

        try {
            $user = User::where('otp_token', $request->reset_token)
                        ->where('otp_expiry', '>', now())
                        ->firstOrFail();

            $user->update([
                'password'    => Hash::make($request->new_password),
                'otp'         => null,
                'otp_expiry'  => null,
                'otp_token'   => null
            ]);

            // Optional: revoke all tokens
            $user->tokens()->delete();

            Log::info("Password reset for {$user->email}");

            return response()->json([
                'status' => 'success',
                'message' => 'Password reset successfully'
            ], 200); // Explicit 200
        } catch (\Exception $e) {
            Log::error('Password reset error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired token',
                'error'   => $e->getMessage() // Optional for debugging
            ], 200); // Still 200 on failure
        }
    }
}
