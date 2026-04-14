<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
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
        $this->call([
            UserSeeder::class,           
            PaymentMethodsSeeder::class, 
        ]);
    }
}