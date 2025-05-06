<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{

    public function getCountryList(Request $request)
    {
        try {
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
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve countries.',
            ], 200);
        }
    }


}
