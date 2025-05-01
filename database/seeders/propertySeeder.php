<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\User;
use Faker\Factory as Faker;

class PropertySeeder extends Seeder
{
    public function run()
    {
        // Truncate the table (delete all records)
        Property::truncate();
        $faker = Faker::create();

        // Get all existing user IDs
        $userIds = User::pluck('id')->toArray();

        foreach (range(1, 5) as $i) {
            $startDate = $faker->dateTimeBetween('-1 year', 'now');
            $endDate = $faker->dateTimeBetween($startDate, '+1 year');

            Property::create([
                'user_id' => $faker->randomElement($userIds),
                'unit_number' => $faker->optional()->buildingNumber,
                'street_number' => $faker->buildingNumber,
                'street_name' => $faker->streetName,
                'suburb' => $faker->city,
                'state' => $faker->state,
                'postcode' => $faker->postcode,
                'country' => $faker->country,
                'contract_start_date' => $startDate->format('Y-m-d'),
                'contract_end_date' => $endDate->format('Y-m-d'),
            ]);
        }
    }
}
