<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\ResidentsInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    public function addProperty(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'unit_number'   => 'required|string|max:255',
            'street_number' => 'required|string|max:255',
            'street_name'   => 'required|string|max:255',
            'suburb'        => 'required|string|max:255',
            'state_id'      => 'required|integer|exists:states,id',  // Ensure valid state_id
            'country_id'    => 'required|integer|exists:countries,id', // Ensure valid country_id
            'post_code'     => 'required|string|max:255',
            'user_id'       => 'required|integer|exists:users,id',
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
            // Create new property record
            Property::create([
                'user_id'       => $request->user_id,
                'unit_number'   => $request->unit_number,
                'street_number' => $request->street_number,
                'street_name'   => $request->street_name,
                'suburb'        => $request->suburb,
                'state_id'      => $request->state_id,
                'country_id'    => $request->country_id,
                'postcode'      => $request->post_code,
            ]);

            // Return minimal response
            return response()->json([
                'status' => 'success',
                'message' => 'Property added successfully.',
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

    public function addResidentInfo(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'resident_name' => 'required|string|max:50',
            'email' => 'required|email|unique:resident_infos,email',
            'phone_number' => 'required|string|max:15',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        try {
            // Create a new record
            ResidentsInfo::create($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Resident Info Added.',
            ], 200); // Return 200 status code for success
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add resident info: ' . $e->getMessage(),
            ], 200); // Return 200 status code for exception
        }
    }

    // public function getResidentInfo()
    // {
    //     try {
    //         $residentInfo = ResidentsInfo::all();

    //         return response()->json([
    //             'status' => 'success',
    //             'resident_info_data' => $residentInfo,
    //         ], 200);

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to fetch resident info: ' . $e->getMessage(),
    //         ], 200);
    //     }
    // }

    public function getResidentInfo(Request $request)
    {
        try {
            // Check if user_id is provided
            $userId = $request->input('user_id');

            if ($userId) {
                // Fetch data based on user_id
                $residentInfo = ResidentsInfo::where('user_id', $userId)->get();

                if ($residentInfo->isEmpty()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'No resident info found for the given user ID.',
                    ], 200);
                }
            } else {
                // Fetch all data if no user_id is provided
                $residentInfo = ResidentsInfo::all();
            }

            return response()->json([
                'status' => 'success',
                'resident_info_data' => $residentInfo,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch resident info: ' . $e->getMessage(),
            ], 200);
        }
    }


    // public function deleteResidentInfo($user_id)
    // {
    //     // Find all personal info records by user_id
    //     $residentInfo = ResidentsInfo::where('user_id', $user_id);

    //     // Check if any records exist
    //     if ($residentInfo->count() == 0) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Resident info not found for this user.',
    //         ], 200);
    //     }

    //     // Delete all personal info records associated with the user
    //     $residentInfo->delete();

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Resident info deleted successfully.',
    //     ], 200);
    // }

    public function deleteResidentInfo(Request $request)
    {
        // Get user_id from request parameters
        $userId = $request->input('user_id');

        // Validate the user_id
        if (!$userId) {
            return response()->json([
                'status' => 'error',
                'message' => 'User ID is required.',
            ], 200);
        }

        try {
            // Find all personal info records by user_id
            $residentInfo = ResidentsInfo::where('user_id', $userId);

            // Check if any records exist
            if ($residentInfo->count() == 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Resident info not found for this user.',
                ], 200);
            }

            // Delete all personal info records associated with the user
            $residentInfo->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Resident info deleted successfully.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete resident info: ' . $e->getMessage(),
            ], 200);
        }
    }


}

  // public function addProperty(Request $request)
    // {
    //     // Validate incoming request data
    //     $validator = Validator::make($request->all(), [
    //         'unit_number'     => 'required|string|max:255',
    //         'street_number'   => 'required|string|max:255',
    //         'street_name'     => 'required|string|max:255',
    //         'suburb'          => 'required|string|max:255',
    //         'state'           => 'required|string|max:255',
    //         'post_code'       => 'required|string|max:255',
    //         'country'         => 'required|string|max:255',
    //         'user_id'         => 'required|integer|exists:users,id', // Ensure valid user_id
    //     ]);

    //     // If validation fails, return error
    //     if ($validator->fails()) {
    //         Log::warning('Validation failed for addProperty', [
    //             'errors' => $validator->errors()->all()
    //         ]);

    //         return response()->json([
    //             'status' => 'error',
    //             'message' => $validator->errors()->first(),
    //         ], 200);
    //     }

    //     try {
    //         // Create new property record
    //         $property = Property::create([
    //             'user_id'        => $request->user_id, // Use provided user_id
    //             'unit_number'    => $request->unit_number,
    //             'street_number'  => $request->street_number,
    //             'street_name'    => $request->street_name,
    //             'suburb'         => $request->suburb,
    //             'state'          => $request->state,
    //             'postcode'       => $request->post_code,
    //             'country'        => $request->country,
    //         ]);

    //         // Return success response
    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Property added successfully.',
    //             'property' => $property,
    //         ], 200);

    //     } catch (\Exception $e) {
    //         // Log error
    //         Log::error('Error adding property: ' . $e->getMessage());

    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to add property. ' . $e->getMessage(),
    //         ], 200);
    //     }
    // }


// namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
// use App\Models\Property;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Log;
// use Tymon\JWTAuth\Facades\JWTAuth;
// use Tymon\JWTAuth\Exceptions\TokenExpiredException;
// use Tymon\JWTAuth\Exceptions\TokenInvalidException;
// use Tymon\JWTAuth\Exceptions\JWTException;

// class PropertyController extends Controller
// {
//     public function __construct()
//     {
//         // Apply JWT auth middleware
//         $this->middleware('jwt.auth');
//     }

//     public function addProperty(Request $request)
//     {
//         Log::info('addProperty method called.'); // Debug: Method entry point

//         try {
//             Log::info('Attempting to authenticate user via JWT.');

//             // Attempt to authenticate the user
//             $user = JWTAuth::parseToken()->authenticate();
//             Log::info('User authenticated successfully.', ['user_id' => $user->id]);

//         } catch (TokenExpiredException $e) {
//             Log::error('Token has expired.', ['error' => $e->getMessage()]);

//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'Token has expired. Please login again.',
//                 'debug' => $e->getMessage()
//             ], 401);

//         } catch (TokenInvalidException $e) {
//             Log::error('Invalid token provided.', ['error' => $e->getMessage()]);

//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'Invalid token. Please login again.',
//                 'debug' => $e->getMessage()
//             ], 401);

//         } catch (JWTException $e) {
//             Log::error('JWT token not found or invalid.', ['error' => $e->getMessage()]);

//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'Token not provided or invalid.',
//                 'debug' => $e->getMessage()
//             ], 401);
//         }

//         // Validate the request data
//         Log::info('Validating request data.', ['request_data' => $request->all()]);

//         $validator = Validator::make($request->all(), [
//             'unit_number'   => 'required|string|max:255',
//             'street_number' => 'required|string|max:255',
//             'street_name'   => 'required|string|max:255',
//             'suburb'        => 'required|string|max:255',
//             'state'         => 'required|string|max:255',
//             'post_code'     => 'required|string|max:255',
//             'country'       => 'required|string|max:255',
//         ]);

//         if ($validator->fails()) {
//             Log::warning('Validation failed.', ['errors' => $validator->errors()->all()]);

//             return response()->json([
//                 'status' => 'error',
//                 'message' => $validator->errors()->first(),
//                 'debug' => $validator->errors()
//             ], 422);
//         }

//         try {
//             Log::info('Creating new property record.');

//             // Create the property
//             $property = Property::create([
//                 'user_id'       => $user->id,
//                 'unit_number'   => $request->unit_number,
//                 'street_number' => $request->street_number,
//                 'street_name'   => $request->street_name,
//                 'suburb'        => $request->suburb,
//                 'state'         => $request->state,
//                 'postcode'      => $request->post_code,
//                 'country'       => $request->country,
//             ]);

//             Log::info('Property created successfully.', ['property_id' => $property->id]);

//             return response()->json([
//                 'status' => 'success',
//                 'message' => 'Property added successfully.',
//                 'property_id' => $property->id
//             ], 201);

//         } catch (\Exception $e) {
//             Log::error('Property creation failed.', ['error' => $e->getMessage()]);

//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'Could not add property.',
//                 'debug' => config('app.debug') ? $e->getMessage() : null
//             ], 500);
//         }
//     }
// }


