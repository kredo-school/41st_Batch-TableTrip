<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Naoya Sato
        User::create([
            'first_name' => 'Naoya',
            'last_name' => 'Sato',
            'user_name' => 'iamnaoyasato',
            'email' => 'satonao@kredo.com',
            'password' => Hash::make('password914'),
            'tel' => '627288238',
            'country' => 'Netherlands',
            'address' => 'Fukushima', 
            'postal_code' => '9758WK',
        ]);

        // 2. Xuan Ng
        User::create([
            'first_name' => 'Xuan',
            'last_name' => 'Ng',
            'user_name' => 'ng.xuan',
            'email' => 'ng.xuan@example.com',
            'password' => Hash::make('password123'),
            'tel' => '09012345678',
            'country' => 'Vietnam',
            'address' => 'Ho Chi Minh City',
            'postal_code' => '700000',
        ]);

        // 3. Haruto Tanaka
        User::create([
            'first_name' => 'Haruto',
            'last_name' => 'Tanaka',
            'user_name' => 'haru_tanaka',
            'email' => 'haru@example.com',
            'password' => Hash::make('password789'),
            'tel' => '08098765432',
            'country' => 'Japan',
            'address' => 'Tokyo, Shibuya',
            'postal_code' => '1500002',
        ]);
    }
}