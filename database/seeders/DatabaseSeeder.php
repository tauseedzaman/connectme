<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Faq;
use App\Models\Group;
use App\Models\Page;
use App\Models\Post;
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

        for ($i = 0; $i < 100; $i++) {
            User::create([
                'uuid' => Str::uuid(),
                'first_name' => fake()->firstname(),
                'last_name' => fake()->lastname(),
                'username' => fake()->username(),
                'gender' => "male",
                'profile' => "profiles/2fMcpEJI6Ybd4DcKZinpOnngxEDmUnGHfzQnJJdY.png",
                // 'thumbnail' => "profiles/jxAjtc7uY9PLx26EytgGTA0dtgqqJKbI8TqF8zbe.png",
                'email' => fake()->SafeEmail(),
                'mobile' => fake()->phoneNumber(),
                "email_verified_at" => now(),
                "mobile_verified_at" => now(),
                'password' => Hash::make("password"),
            ]);
        }

        // for ($i = 0; $i < 100; $i++) {
        //     Post::create([
        //         "uuid" => Str::uuid(),
        //         "user_id" => User::InRandomOrder()->first()->id,
        //         "content" => fake()->sentence(rand(10, 50)),
        //         "likes" => rand(200, 10000),
        //         "comments" => rand(200, 10000),
        //     ]);
        // }
        for ($i = 0; $i < 100; $i++) {
            Page::create([
                "uuid" => Str::uuid(),
                "user_id" => User::InRandomOrder()->first()->id,
                "icon" => "pages/6Byv86zmAQ0p4rk8rZcImPD3GqPHDWtQldLwjUat.jpg",
                "thumbnail" => "pages/EJx2R6bIGp2eRWzUoZafrTW3xAgdknF78rKB8pHt.png",
                "description" => fake()->sentence(rand(10, 50)),
                "name" => fake()->username(),
                "location" => fake()->sentence(3),
                "type" => fake()->sentence(3),
                "members" => rand(200, 10000),
            ]);
        }

        for ($i = 0; $i < 100; $i++) {
            Group::create([
                "uuid" => Str::uuid(),
                "user_id" => User::InRandomOrder()->first()->id,
                "icon" => "pages/6Byv86zmAQ0p4rk8rZcImPD3GqPHDWtQldLwjUat.jpg",
                "thumbnail" => "pages/EJx2R6bIGp2eRWzUoZafrTW3xAgdknF78rKB8pHt.png",
                "description" => fake()->sentence(rand(10, 50)),
                "name" => fake()->username(),
                "location" => fake()->sentence(3),
                "type" => fake()->sentence(3),
                "members" => rand(200, 10000),
            ]);
        }



        $user = User::create([
            'uuid' => Str::uuid(),
            'first_name' => "tauseed",
            'last_name' => "zaman",
            'username' => "tauseedzaman",
            'gender' => "male",
            'profile' => "profiles/2fMcpEJI6Ybd4DcKZinpOnngxEDmUnGHfzQnJJdY.png",
            'email' => "tauseedzaman@connectme.com",
            'mobile' => "",
            "email_verified_at" => now(),
            "mobile_verified_at" => now(),
            'password' => Hash::make("password"),
        ]);

        $page = Page::create([
            "uuid" => Str::uuid(),
            "user_id" =>  $user->id,
            "icon" => "pages/6Byv86zmAQ0p4rk8rZcImPD3GqPHDWtQldLwjUat.jpg",
            "thumbnail" => "pages/EJx2R6bIGp2eRWzUoZafrTW3xAgdknF78rKB8pHt.png",
            "description" => fake()->sentence(rand(10, 50)),
            "name" => 'tauseed.zaman',
            "location" => fake()->sentence(3),
            "type" => fake()->sentence(3),
            "members" => rand(200, 10000),
        ]);

        $group = Group::create([
            "uuid" => Str::uuid(),
            "user_id" => $user->id,
            "icon" => "pages/6Byv86zmAQ0p4rk8rZcImPD3GqPHDWtQldLwjUat.jpg",
            "thumbnail" => "pages/EJx2R6bIGp2eRWzUoZafrTW3xAgdknF78rKB8pHt.png",
            "description" => fake()->sentence(rand(10, 50)),
            "name" => fake()->username(),
            "location" => fake()->sentence(3),
            "type" => fake()->sentence(3),
            "members" => rand(200, 10000),
        ]);

        // for ($i = 0; $i < 100; $i++) {
        //     Post::create([
        //         "uuid" => Str::uuid(),
        //         "user_id" => $user->id,
        //         "content" => fake()->sentence(rand(10, 50)),
        //         "page_id" => $page->id,
        //         'is_page_post' => 1,
        //         'status' => 'pending',
        //         "likes" => rand(200, 10000),
        //         "comments" => rand(200, 10000),
        //     ]);
        // }

        // for ($i = 0; $i < 100; $i++) {
        //     Post::create([
        //         "uuid" => Str::uuid(),
        //         "user_id" => $user->id,
        //         "content" => fake()->sentence(rand(10, 50)),
        //         "group_id" => $group->id,
        //         'status' => 'pending',
        //         'is_group_post' => 1,
        //         "likes" => rand(200, 10000),
        //         "comments" => rand(200, 10000),
        //     ]);
        // }



        // sed faq or help disk
        for ($i = 0; $i < 100; $i++) {
            Faq::create([
                "question" => fake()->sentence(),
                "answer" => fake()->paragraph(),
            ]);
        }
    }
}
