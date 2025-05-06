<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run()
    {
        // Create 10 fake countries
        \App\Models\Country::factory(20)->create();
    }
}
