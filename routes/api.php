<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\PropertyController;

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

Route::prefix('countries')->group(function () {
    // Get Country List
    Route::get('/', [LocationController::class, 'getCountryList']);
    Route::get('/state_list', [LocationController::class, 'getStateList']);
});

    // Property Routes (Protected by Sanctum Authentication)
    Route::middleware('auth:sanctum')->group(function () {
         // Add Property (Requires Authentication)
         Route::post('/add_property', [PropertyController::class, 'addProperty']);
     });
 
//  Route::get('/debug-token', function (Request $request) {
//     $authHeader = $request->header('Authorization');

//     if (! $authHeader) {
//         return response()->json(['error' => 'No Authorization header'], 401);
//     }

//     $token = str_replace('Bearer ', '', $authHeader);

//     $accessToken = PersonalAccessToken::findToken($token);

//     if (! $accessToken) {
//           return response()->json($request->headers->all());
//     }

//     $user = $accessToken->tokenable;

//     return response()->json([
//         'token_id' => $accessToken->id,
//         'token_user_id' => $accessToken->tokenable_id,
//         'user_model_type' => $accessToken->tokenable_type,
//         'user' => $user,
//     ]);
// });

// Route::get('/debug-headers', function (Request $request) {
//     return response()->json($request->headers->all());
// });

// Route::get('/clear-config-cache', function() {
//     \Artisan::call('config:clear');
//     return response()->json(['message' => 'Config cache cleared successfully!']);
// });

// Route::get('/debug-token', function (Request $request) {
//     Log::info('Authorization Header: ', [$request->header('Authorization')]);
//     return response()->json($request->headers->all());
// });

