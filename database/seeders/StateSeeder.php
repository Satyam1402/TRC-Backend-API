<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\Country;

class StateSeeder extends Seeder
{
    public function run()
    {
        // Create 50 fake states with random country_id
        // State::factory()->count(50)->create();
        
        // Get a list of all country IDs that already exist
        $countryIds = Country::pluck('id')->toArray();

        // Create states for each country
        foreach ($countryIds as $countryId) {
            State::factory()->count(5)->create([
                'country_id' => $countryId
            ]);
        }

    }
}
