<?php

namespace App\Http\Controllers\Api;

use App\Models\Property;
use App\Models\UserToken;
use App\Models\User;
use App\Models\UserReward;
use Illuminate\Http\Request;
use App\Models\ResidentsInfo;
use App\Services\RewardService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    public function addProperty(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'unit_number' => 'required|string|max:255',
            'street_number' => 'required|string|max:255',
            'street_name' => 'required|string|max:255',
            'suburb' => 'required|string|max:255',
            'state_id' => 'required|string|max:255',
            'post_code' => 'required|string|max:255',
            'country_id' => 'required|string|max:255',
            'token' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid input. Please check the information and try again.',
            ], 200);
        }

        try {
            // Validate the token (Check if the token exists and is valid)
            $token = $request->token;
            $userToken = UserToken::where('token', $token)
                ->where('expires_at', '>', now()) // Check token expiration
                ->first();

            if (!$userToken) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid or expired token.',
                ], 200);
            }

            // Create the property
            $property = Property::create([
                'unit_number' => $request->unit_number,
                'street_number' => $request->street_number,
                'street_name' => $request->street_name,
                'suburb' => $request->suburb,
                'state_id' => $request->state_id,
                'postcode' => $request->post_code,
                'country_id' => $request->country_id,
                'user_id' => $userToken->user_id, // Assuming each property is linked to a user
            ]);

            // Reward 1 star for adding a property
            $user = $userToken->user;
            RewardService::giveStar($user, 'add_property', $property->id, 'property');

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Property added successfully.',
                'stars'   => $user->fresh()->stars,
            ], 200);

        } catch (Exception $e) {
            Log::error('Add property error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while adding the property. Please try again.',
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
            'token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        try {
            // Check if the token exists in the UserToken table
            $userToken = UserToken::where('token', $request->token)->first();

            if (!$userToken) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid token. Please login again.',
                ], 200);
            }

            // Create a new record using the user_id associated with the token
            ResidentsInfo::create([
                'resident_name' => $request->resident_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'user_id' => $userToken->user_id,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Resident Info Added.',
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Add Resident Info Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add resident info. Please try again.',
            ], 200);
        }
    }

    public function getResidentInfo(Request $request)
    {
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'token'  => 'required|string',
                'user_id' => 'nullable|integer|exists:users,id',
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

            $userId = $request->input('user_id');

            if ($userId) {
                // Fetch data based on user_id
                $residentInfo = ResidentsInfo::where('user_id', $userId)->get();
            } else {
                // Fetch all data
                $residentInfo = ResidentsInfo::all();
            }

            if ($residentInfo->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No resident info found.',
                ], 200);
            }

            return response()->json([
                'status' => 'success',
                'resident_info_data' => $residentInfo,
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Get Resident Info Error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch resident info. Please try again.',
            ], 200);
        }
    }

    public function updateResidentInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'resident_info_id' => 'required|integer',
            'resident_name'    => 'required|string|max:50',
            'email'            => 'required|email|unique:resident_infos,email,' . $request->resident_info_id,
            'phone_number'     => 'required|string|max:15',
            'token'            => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $id = $request->resident_info_id;

        try {
            $userToken = UserToken::where('token', $request->token)->first();

            if (!$userToken) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid token. Please login again.',
                ], 200);
            }

            $resident = ResidentsInfo::where('id', $id)
                ->where('user_id', $userToken->user_id)
                ->first();

            if (!$resident) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Resident record not found or unauthorized.',
                ], 200);
            }

            $resident->update([
                'resident_name' => $request->resident_name,
                'email'         => $request->email,
                'phone_number'  => $request->phone_number,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Resident Info Updated Successfully.',
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Update Resident Info Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update resident info. Please try again.',
            ], 200);
        }
    }

    public function deleteResidentInfo(Request $request)
    {
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'token' => 'required|string',
                'user_id' => 'nullable|integer|exists:users,id',
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

            $userId = $request->input('user_id');

            if ($userId) {
                // Delete specific user's resident info
                $residentInfo = ResidentsInfo::where('user_id', $userId);

                if ($residentInfo->count() == 0) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Resident info not found for the specified user.',
                    ], 200);
                }

                $residentInfo->delete();

                return response()->json([
                    'status' => 'success',
                    'message' => "Resident info for user_id {$userId} deleted successfully.",
                ], 200);

            } else {
                // Delete all resident info
                ResidentsInfo::truncate();

                return response()->json([
                    'status' => 'success',
                    'message' => 'All resident info deleted successfully.',
                ], 200);
            }

        } catch (\Exception $e) {
            \Log::error('Delete Resident Info Error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete resident info. Please try again.',
            ], 200);
        }
    }
}
