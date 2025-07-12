<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MakeAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exists = User::where('username', "admin")->exists();
        if(!$exists) {
            User::create([
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => Carbon::now(),
                'type' => 1
            ]);
        }
    }
}
