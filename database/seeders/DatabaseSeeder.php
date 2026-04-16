<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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
            ProductSeeder::class,
            ReservationSeeder::class,
            InquirySeeder::class,        
            NotificationSeeder::class,   
        ]);

        
    }
}