<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Listing;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(5)->create();
        $user = User::factory()->create([
            'name' => 'magrhrapy',
            'email' => 'maghrapy@gmail.com'
        ]);

        Listing::factory(6)->create([
            'user_id' => $user->id
        ]);

        // Listing::create([
        //     'title' => 'laravel senior developer',
        //     'tags' => 'laravel, javascript',
        //     'company' => 'ACME corp',
        //     'location'=>'cairo, egypt',
        //     'email' => 'email@gmail.com',
        //     'website' => 'https://www.email.com',
        //     'description' => 'this is description'
        // ]);
        // Listing::create([
        //     'title' => 'react senior developer',
        //     'tags' => 'javascript',
        //     'company' => 'ACME corp',
        //     'location'=>'cairo, egypt',
        //     'email' => 'email@gmail.com',
        //     'website' => 'https://www.email.com',
        //     'description' => 'this is description'
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
