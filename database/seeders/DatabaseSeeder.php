<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            PropertySeeder::class,
            StateSeeder::class,
            PropertySeeder::class,
            StaticContentSeeder::class,
            RentCollectionSeeder::class,
            CountrySeeder::class,
        ]);
    }
}
