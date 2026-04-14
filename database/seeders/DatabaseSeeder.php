<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\Category::firstOrCreate(
            ['name' => 'Meal Kit']
        );

        $this->call([
            UserSeeder::class,
            PaymentMethodsSeeder::class,
        ]);

        $this->call([
            ProductSeeder::class,
            ReservationSeeder::class,
        ]);

        
        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'user_name' => 'Test User',
            'email' => 'test@example.com',
            'tel' => '0000000000',  
            'country' => 'Japan',    
        ]);
    }
}