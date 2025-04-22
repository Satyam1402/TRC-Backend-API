<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create an instance of Faker
        $faker = Faker::create();

        // For example, creating 10 fake users
        foreach (range(1, 5) as $i) {
            User::create([
                'first_name' => $faker->firstName,  // Fake first name
                'last_name' => $faker->lastName,    // Fake last name
                'name' => $faker->firstName . ' ' . $faker->lastName, // Concatenate first and last name
                'email' => $faker->unique()->safeEmail,  // Fake email, unique
                'phone' => $faker->phoneNumber,     // Fake phone number
                'password' => bcrypt('password123'),  // Fake password, encrypted using bcrypt
                'user_role' => 'user', // Provide a default role here
            ]);
        }
    }
}
