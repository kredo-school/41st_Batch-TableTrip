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

            DemoProductSeeder::class, // ← ここに上げる🔥

            DemoOrderSeeder::class,
            DemoReservationSeeder::class,
            DemoPointHistorySeeder::class,
            DemoStampSeeder::class,

            DemoCouponSeeder::class,
            DemoUserCouponSeeder::class,

            DemoReviewSeeder::class,

            InquirySeeder::class,
        ]);
    }
}