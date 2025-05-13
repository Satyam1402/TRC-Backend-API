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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtAuthController extends Controller
{
    // public function _construct(){
    //     $this->middleware('auth:api',['except'=>['login','register']])
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
                'message' => 'Invalid input.',
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
                'user_role'  => 'tenant'
            ]);

            $token = JWTAuth::fromUser($user);

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

        } catch (Exception $e) {
            Log::error('Registration error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Registration failed.',
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
                'message' => 'Invalid input.',
            ], 200);
        }

        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid credentials'
                ], 200);
            }

            $user = auth()->user();

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

        } catch (JWTException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Could not create token',
            ], 500);
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
                'message' => 'Invalid input.',
            ], 200);
        }

        try {
            $user = User::where('email', $request->email)->firstOrFail();

            $plainOtp = $user->generateOtp(); // You must implement this method in User model

            Mail::to($user->email)->send(new OtpMail($plainOtp));

            return response()->json([
                'status' => 'success',
                'message' => 'OTP sent to your email',
                'data' => [
                    'otp_expiry' => $user->otp_expiry->format('Y-m-d H:i:s')
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('OTP send error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send OTP.',
            ], 200);
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
                'message' => 'Invalid input.',
            ], 200);
        }

        try {
            $user = User::where('email', $request->email)->firstOrFail();

            if (!$user->validateOtp($request->otp)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid or expired OTP'
                ], 200);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'OTP verified',
                'data' => [
                    'reset_token' => $user->otp_token,
                    'token_expiry' => $user->otp_expiry ? $user->otp_expiry->format('Y-m-d H:i:s') : null
                ]
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
            'reset_token'  => 'required',
            'new_password' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
            ], 200);
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

            return response()->json([
                'status' => 'success',
                'message' => 'Password reset successfully'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Password reset error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired token',
            ], 200);
        }
    }

    public function refreshToken()
    {
        try {
            $token = JWTAuth::parseToken()->refresh();
            return response()->json([
                'status' => 'success',
                'token' => $token,
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token refresh failed.',
            ], 500);
        }
    }
}
