<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exists = Location::where('name', "Default")->exists();
        if(!$exists){
            Location::create([
                'name' => "Default",
                'address' => "5505 W 20th Ave suite 200",
                'city' => "Edgewater",
                'state' => "Colorado",
                'zip_code' => "80214",
                'phone_number' => "+1 (720) 524-8882",
                'user_id' => 1,
            ]);
        }

    }
}
