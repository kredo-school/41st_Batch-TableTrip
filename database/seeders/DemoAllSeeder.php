<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DemoAllSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DemoUserSeeder::class,
            DemoRestaurantSeeder::class,
            ProductSeeder::class,
            InquirySeeder::class,
            DemoOrderSeeder::class,
            DemoPointHistorySeeder::class,
            DemoReservationSeeder::class,
            DemoStampSeeder::class,
            DemoCouponSeeder::class,
            DemoUserCouponSeeder::class,
            DemoReviewSeeder::class,
        ]);
    }
}