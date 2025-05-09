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

//  Route::get('/clear-config-cache', function() {
//     \Artisan::call('config:clear');
//     return response()->json(['message' => 'Config cache cleared successfully!']);
// });

//  =============================================================================================

 // Property Routes (Protected by Sanctum Authentication)
// Route::middleware('auth:sanctum')->group(function () {
//      // Add Property (Requires Authentication)
//      Route::post('/add_property', [PropertyController::class, 'addProperty']);
//  });
 
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth:sanctum')->post('/add_property', function (Request $request) {
//     return response()->json(['user' => $request->user()]);
// });

// Route::middleware('auth:sanctum')->post('/add_property', function (Request $request) {
//     return response()->json([
//         'user' => $request->user(),
//         'auth_check' => auth()->check(),
//         'guard' => auth()->guard()->getName(),
//     ]);
// });

// Route::middleware('auth:sanctum')->get('/test', function (Request $request) {
//     return response()->json([
//         'status' => 'success',
//         'user' => auth()->user() // This will return the authenticated user's details
//     ]);
// });
