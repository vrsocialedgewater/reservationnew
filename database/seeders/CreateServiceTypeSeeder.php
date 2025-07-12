<?php

namespace Database\Seeders;

use App\Models\ServiceType;
use Illuminate\Database\Seeder;

class CreateServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exists = ServiceType::where('title', "Event")->exists();
        if(!$exists){
            $service_types = [
                [
                    'id' => 1,
                    'title' => "Event",
                    'user_id' => 1,
                    'created_at' => "2025-01-01 01:30:22",
                    'updated_at' => "2024-01-01 01:30:22",
                ],
                [
                    'id' => 2,
                    'title' => "Experience",
                    'user_id' => 1,
                    'created_at' => "2025-01-01 01:30:22",
                    'updated_at' => "2024-01-01 01:30:22",
                ],
            ];

            ServiceType::insert($service_types);
        }
    }
}
