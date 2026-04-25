<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Category::firstOrCreate([
            'name' => 'Meal Kit'
        ]);

        $this->call([
            UserSeeder::class,
            PaymentMethodsSeeder::class,
            RestaurantSeeder::class,
            ReservationSeeder::class,
            NotificationSeeder::class,
            PointHistorySeeder::class,
        ]);

        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'user_name' => 'testuser',
            'email' => 'test@example.com',
            'tel' => '0000000000',
            'country' => 'Japan',
        ]);
    }
}