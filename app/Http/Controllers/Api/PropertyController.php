<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function __construct()
    {
        // Ensure that every method requires authentication using Sanctum
        $this->middleware('auth:sanctum');
    }

    public function addProperty(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'unit_number'     => 'required|string|max:255',
            'street_number'   => 'required|string|max:255',
            'street_name'     => 'required|string|max:255',
            'suburb'          => 'required|string|max:255',
            'state'           => 'required|string|max:255',
            'post_code'       => 'required|string|max:255',
            'country'         => 'required|string|max:255',
        ]);

        // If validation fails, return error
        if ($validator->fails()) {
            Log::warning('Validation failed for addProperty', [
                'errors' => $validator->errors()->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        try {
            // Get the authenticated user (Sanctum handles token validation)
            $user = auth()->user(); // This returns the authenticated user

            // Create new property record and associate it with the authenticated user
            $property = Property::create([
                'user_id'        => $user->id,  // Use the authenticated user's ID
                'unit_number'    => $request->unit_number,
                'street_number'  => $request->street_number,
                'street_name'    => $request->street_name,
                'suburb'         => $request->suburb,
                'state'          => $request->state,
                'postcode'       => $request->post_code,
                'country'        => $request->country,
            ]);

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Property Added.',
            ], 200);

        } catch (\Exception $e) {
            // Log error
            Log::error('Error adding property: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add property.',
            ], 200);
        }
    }
}

// class PropertyController extends Controller
// {
//     public function __construct()
//     {
//         $this->middleware('auth:sanctum')->except(['optionsPreflight']);
//     }

//     // Handle OPTIONS preflight requests
//     public function optionsPreflight()
//     {
//         return response()->json([], 200)
//             ->header('Access-Control-Allow-Origin', '*')
//             ->header('Access-Control-Allow-Methods', 'POST, OPTIONS')
//             ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
//     }

//     public function addProperty(Request $request)
//     {
//         // Debug: Log incoming request details
//         Log::debug('Property Add Request', [
//             'headers' => $request->headers->all(),
//             'token' => $request->bearerToken(),
//             'ip' => $request->ip(),
//             'user_agent' => $request->userAgent()
//         ]);

//         // Verify authentication
//         if (!Auth::check()) {
//             Log::error('Authentication Failed', [
//                 'token_present' => $request->hasHeader('Authorization'),
//                 'token' => $request->bearerToken(),
//                 'expected_format' => 'Bearer {token_id}|{plain_text_token}'
//             ]);
            
//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'Unauthenticated',
//                 'debug' => 'Token validation failed. Please ensure you are sending the complete token in the Authorization header.'
//             ], 401);
//         }

//         // Validate request
//         $validator = Validator::make($request->all(), [
//             'unit_number'     => 'required|string|max:255',
//             'street_number'   => 'required|string|max:255',
//             'street_name'     => 'required|string|max:255',
//             'suburb'          => 'required|string|max:255',
//             'state'           => 'required|string|max:255',
//             'post_code'       => 'required|string|max:255',
//             'country'         => 'required|string|max:255',
//         ]);

//         if ($validator->fails()) {
//             Log::warning('Validation failed', ['errors' => $validator->errors()]);
//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'Validation failed',
//                 'errors' => $validator->errors()
//             ], 422);
//         }

//         try {
//             $user = Auth::user();
//             Log::debug('Authenticated User', ['user_id' => $user->id, 'email' => $user->email]);

//             $property = Property::create([
//                 'user_id'        => $user->id,
//                 'unit_number'    => $request->unit_number,
//                 'street_number'  => $request->street_number,
//                 'street_name'    => $request->street_name,
//                 'suburb'         => $request->suburb,
//                 'state'          => $request->state,
//                 'postcode'       => $request->post_code,
//                 'country'        => $request->country,
//             ]);

//             Log::info('Property created successfully', ['property_id' => $property->id]);

//             return response()->json([
//                 'status' => 'success',
//                 'message' => 'Property added successfully',
//                 'property_id' => $property->id
//             ], 201);

//         } catch (\Exception $e) {
//             Log::error('Property Creation Error', [
//                 'error' => $e->getMessage(),
//                 'trace' => $e->getTraceAsString()
//             ]);

//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'Server error while creating property',
//                 'error_details' => config('app.debug') ? $e->getMessage() : null
//             ], 500);
//         }
//     }
// }