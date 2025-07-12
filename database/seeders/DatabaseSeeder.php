<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([MakeAdminUser::class]);
        $this->call([CreateLocationSeeder::class]);
        $this->call([CreateServiceTypeSeeder::class]);
        $this->call([MakeServiceSeeder::class]);
        $this->call([MakeDaySeeder::class]);
//        $this->call([MakeBookingScheduleSeeder::class]);
    }
}
