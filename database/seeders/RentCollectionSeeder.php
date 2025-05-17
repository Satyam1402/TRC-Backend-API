<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RentCollection;
use App\Models\User;
use App\Models\Property;
use Carbon\Carbon;

class RentCollectionSeeder extends Seeder
{
    public function run()
    {
        $users = User::pluck('id')->toArray();
        $properties = Property::pluck('id')->toArray();

        if (empty($users) || empty($properties)) {
            echo "No users or properties found. Please seed the users and properties first.";
            return;
        }

        $data = [];

        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'property_id' => $properties[array_rand($properties)],
                'user_id' => $users[array_rand($users)],
                'amount' => rand(100, 500),
                'due_date' => Carbon::now()->addDays(rand(-15, 15))->format('Y-m-d'),
                'status' => rand(0, 1) ? 'paid' : 'unpaid',
                'receipt_number' => 'REC' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'inspection_report' => 'Inspection Report ' . $i,
            ];
        }

        RentCollection::insert($data);

        echo "10 Rent collections seeded successfully.";
    }
}
