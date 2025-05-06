<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\LocationController;

/*
|--------------------------------------------------------------------------
| API Routes - Sanctum Protected
|--------------------------------------------------------------------------
*/

// Public Routes (No Authentication)
Route::prefix('auth')->group(function () {
    // Authentication
    Route::post('/login', [ApiAuthController::class, 'login'])
         ->middleware('throttle:10,1'); // 5 requests per minute

    Route::post('/register', [ApiAuthController::class, 'register']);

    // Password Reset Flow
    Route::post('/forgot-password', [ApiAuthController::class, 'sendOtp'])
         ->middleware('throttle:3,1'); // 3 OTP requests per hour

    Route::post('/verify-otp', [ApiAuthController::class, 'verifyOtp'])
         ->middleware('throttle:5,1'); // 5 OTP attempts per minute

    Route::post('/reset-password', [ApiAuthController::class, 'resetPassword'])
         ->middleware('throttle:3,1'); // 5 password reset attempts per minute
});

Route::prefix('countries')->middleware('auth:sanctum')->group(function () {
    // Get Country List
    Route::get('/', [LocationController::class, 'getCountryList']);
});
