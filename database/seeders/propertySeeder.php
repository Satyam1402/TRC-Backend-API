<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use Faker\Factory as Faker;

class PropertySeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks to allow truncating tables with foreign key constraints
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the table (delete all records)
        Property::truncate();
        
        // Re-enable foreign key checks
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = Faker::create();

        // Get all existing user IDs
        $userIds = User::pluck('id')->toArray();

        // Get all existing country and state IDs
        $countryIds = Country::pluck('id')->toArray();
        $stateIds = State::pluck('id')->toArray();

        foreach (range(1, 5) as $i) {
            $startDate = $faker->dateTimeBetween('-1 year', 'now');
            $endDate = $faker->dateTimeBetween($startDate, '+1 year');

            Property::create([
                'user_id'           => $faker->randomElement($userIds),
                'unit_number'       => $faker->optional()->buildingNumber,
                'street_number'     => $faker->buildingNumber,
                'street_name'       => $faker->streetName,
                'suburb'            => $faker->city,
                'state_id'          => $faker->randomElement($stateIds),  // Use state_id
                'postcode'          => $faker->postcode,
                'country_id'        => $faker->randomElement($countryIds),  // Use country_id
                'contract_start_date' => $startDate->format('Y-m-d'),
                'contract_end_date'   => $endDate->format('Y-m-d'),
            ]);
        }
    }
}
