<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::create([
            'uuid' => Str::uuid(),
            'first_name' => "tauseed",
            'last_name' => "zaman",
            'username' => "tauseedzaman",
            'gender' => "male",
            'profile' => "profiles/2fMcpEJI6Ybd4DcKZinpOnngxEDmUnGHfzQnJJdY.png",
            'email' => "tauseedzaman@connectme.com",
            'mobile' => "",
            'password' => Hash::make("password"),
        ]);
    }
}
