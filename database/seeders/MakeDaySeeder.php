<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MakeDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exists = Day::where('name', "Monday")->exists();
        if(!$exists){
            $days = [
                [
                    'name' => "Monday",
                ],
                [
                    'name' => "Tuesday",
                ],
                [
                    'name' => "Wednesday",
                ],
                [
                    'name' => "Thursday",
                ],
                [
                    'name' => "Friday",
                ],
                [
                    'name' => "Saturday",
                ],
                [
                    'name' => "Sunday",
                ]
            ];
            Day::insert($days);
        }
    }
}
