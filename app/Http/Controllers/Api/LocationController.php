<?php

namespace App\Http\Controllers\Api;

use App\Models\State;
use App\Models\Country;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class LocationController extends Controller
{

    // public function getCountryList(Request $request)
    // {
    //     try {
    //         // Retrieve all countries from the database
    //         $countries = Country::all();

    //         // Transform the countries data to include id and value (where value is the name)
    //         $countryList = $countries->map(function ($country) {
    //             return [
    //                 'id' => $country->id,
    //                 'value' => $country->name,  // Map 'name' to 'value'
    //             ];
    //         });

    //         // Return the transformed response with the country list
    //         return response()->json([
    //             'status' => 'success',
    //             'country_list' => $countryList
    //         ], 200);
    //     } catch (\Exception $e) {
    //         // Return the error response if something goes wrong
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to retrieve countries.',
    //         ], 200);
    //     }
    // }

    public function getCountryList(Request $request)
    {
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'token' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first(),
                ], 200);
            }

            // Verify the token
            $userToken = UserToken::where('token', $request->token)->first();

            if (!$userToken) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid token. Please login again.',
                ], 200);
            }

            // Retrieve all countries from the database
            $countries = Country::all();

            // Transform the countries data to include id and value (where value is the name)
            $countryList = $countries->map(function ($country) {
                return [
                    'id' => $country->id,
                    'value' => $country->name,  // Map 'name' to 'value'
                ];
            });

            // Return the transformed response with the country list
            return response()->json([
                'status' => 'success',
                'country_list' => $countryList
            ], 200);

        } catch (\Exception $e) {
            // Return the error response if something goes wrong
            \Log::error('Get Country List Error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve countries.',
            ], 200);
        }
    }

    // public function getStateList(Request $request)
    // {
    //     // Log every request for debugging
    //     Log::info('API Request received for /state_list', [
    //         'method' => $request->method(),
    //         'ip' => $request->ip(),
    //         'query' => $request->query(),
    //         'timestamp' => now()
    //     ]);

    //     try {
    //         // Retrieve all states from the database
    //         $states = State::all();

    //         // Check if states exist
    //         if ($states->isEmpty()) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => 'No states found.',
    //             ], 200);
    //         }

    //         // Transform the states data to match the required format
    //         $stateList = $states->map(function ($state) {
    //             return [
    //                 'id' => $state->id,
    //                 'value' => $state->name, // Map 'name' to 'value'
    //             ];
    //         });

    //         // Return the transformed response with the state list
    //         return response()->json([
    //             'status' => 'success',
    //             'state_list' => $stateList,
    //         ], 200);
    //     } catch (\Exception $e) {
    //         // Log the error
    //         Log::error('Error retrieving states.', [
    //             'message' => $e->getMessage(),
    //             'timestamp' => now()
    //         ]);

    //         // Return the error response
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to retrieve states.',
    //         ], 200);
    //     }
    // }

    // public function getStateList(Request $request)
    // {
    //     // Log every request for debugging
    //     Log::info('API Request received for /state_list', [
    //         'method' => $request->method(),
    //         'ip' => $request->ip(),
    //         'query' => $request->query(),
    //         'timestamp' => now()
    //     ]);

    //     try {
    //         // Get the country_id from query parameters or form-data
    //         $countryId = $request->input('country_id');

    //         // Validate the country_id if provided
    //         if ($countryId) {
    //             $states = State::where('country_id', $countryId)->get();
    //         } else {
    //             $states = State::all();
    //         }

    //         // Check if states exist
    //         if ($states->isEmpty()) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => 'No states found for the specified country.',
    //             ], 200);
    //         }

    //         // Transform the states data to match the required format
    //         $stateList = $states->map(function ($state) {
    //             return [
    //                 'id' => $state->id,
    //                 'value' => $state->name, // Map 'name' to 'value'
    //             ];
    //         });

    //         // Return the transformed response with the state list
    //         return response()->json([
    //             'status' => 'success',
    //             'state_list' => $stateList,
    //         ], 200);

    //     } catch (\Exception $e) {
    //         // Log the error
    //         Log::error('Error retrieving states.', [
    //             'message' => $e->getMessage(),
    //             'timestamp' => now()
    //         ]);

    //         // Return the error response
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to retrieve states.',
    //         ], 200);
    //     }
    // }

    public function getStateList(Request $request)
    {
        // Log every request for debugging
        Log::info('API Request received for /state_list', [
            'method' => $request->method(),
            'ip' => $request->ip(),
            'query' => $request->query(),
            'timestamp' => now()
        ]);

        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'token' => 'required|string',
                'country_id' => 'nullable|integer|exists:countries,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first(),
                ], 200);
            }

            // Verify token
            $userToken = UserToken::where('token', $request->token)->first();

            if (!$userToken) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid token. Please login again.',
                ], 200);
            }

            // Get the country_id from query parameters or form-data
            $countryId = $request->input('country_id');

            // Fetch states based on country_id if provided
            $states = $countryId
                ? State::where('country_id', $countryId)->get()
                : State::all();

            // Check if states exist
            if ($states->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No states found.',
                ], 200);
            }

            // Transform the states data to match the required format
            $stateList = $states->map(function ($state) {
                return [
                    'id' => $state->id,
                    'value' => $state->name,
                ];
            });

            // Return the transformed response with the state list
            return response()->json([
                'status' => 'success',
                'state_list' => $stateList,
            ], 200);

        } catch (\Exception $e) {
            // Log the error
            Log::error('Error retrieving states.', [
                'message' => $e->getMessage(),
                'timestamp' => now()
            ]);

            // Return the error response
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve states.',
            ], 200);
        }
    }
}
