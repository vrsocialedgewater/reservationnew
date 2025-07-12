<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MakeServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exists = Service::exists();
        if(!$exists){

            //Monday
            $services = [
                [
                    'title' => "Race Simulator",
                    'description' => "",
                    'price' => 49.00,
                    'service_type_id' => 2,
                    'slot' => 6,
                    'user_id' => 1,
                    'created_at' => "2025-01-01 01:30:22",
                    'updated_at' => "2024-01-01 01:30:22",
                ],
                [
                    'title' => "Free Roam",
                    'description' => "",
                    'price' => 49.00,
                    'service_type_id' => 2,
                    'slot' => 8,
                    'user_id' => 1,
                    'created_at' => "2025-01-01 01:30:22",
                    'updated_at' => "2024-01-01 01:30:22",
                ],
                [
                    'title' => "Escape room",
                    'description' => "",
                    'price' => 49.00,
                    'service_type_id' => 2,
                    'slot' => 6,
                    'user_id' => 1,
                    'created_at' => "2025-01-01 01:30:22",
                    'updated_at' => "2024-01-01 01:30:22",
                ],
                [
                    'title' => "Gold Simulator",
                    'description' => "",
                    'price' => 49.00,
                    'service_type_id' => 2,
                    'slot' => 6,
                    'user_id' => 1,
                    'created_at' => "2025-01-01 01:30:22",
                    'updated_at' => "2024-01-01 01:30:22",
                ],

            ];
            Service::insert($services);

        }
    }
}
