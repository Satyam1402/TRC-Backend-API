<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use Faker\Factory as Faker;

class PropertySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $i) {
            Property::create([
                'unit_number' => $faker->optional()->buildingNumber,
                'street_number' => $faker->buildingNumber,
                'street_name' => $faker->streetName,
                'suburb' => $faker->city,
                'state' => $faker->state,
                'postcode' => $faker->postcode,
                'country' => $faker->country,
            ]);
        }
    }
}
