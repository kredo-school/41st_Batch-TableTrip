<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class DemoCouponSeeder extends Seeder
{
    public function run(): void
    {
        $coupons = [

            // Welcome
            ['name' => 'Welcome 10% OFF', 'discount_type' => 'percentage', 'discount_value' => 10],

            // Rank Up
            ['name' => 'Silver Rank Reward 10% OFF', 'discount_type' => 'percentage', 'discount_value' => 10],
            ['name' => 'Gold Rank Reward 15% OFF', 'discount_type' => 'percentage', 'discount_value' => 15],
            ['name' => 'Diamond Rank Reward 20% OFF', 'discount_type' => 'percentage', 'discount_value' => 20],

            // Stamp Rewards
            ['name' => '5% OFF (8 Stamps)', 'discount_type' => 'percentage', 'discount_value' => 5],
            ['name' => '10% OFF (16 Stamps)', 'discount_type' => 'percentage', 'discount_value' => 10],
            ['name' => '15% OFF (24 Stamps)', 'discount_type' => 'percentage', 'discount_value' => 15],
            ['name' => '20% OFF (32 Stamps)', 'discount_type' => 'percentage', 'discount_value' => 20],
            ['name' => '25% OFF (40 Stamps)', 'discount_type' => 'percentage', 'discount_value' => 25],
            ['name' => '50% OFF (47 Stamps)', 'discount_type' => 'percentage', 'discount_value' => 50],

            // Special
            ['name' => 'Free Meal Kit', 'discount_type' => 'free_item', 'discount_value' => 0],
            ['name' => 'Free Shipping', 'discount_type' => 'free_shipping', 'discount_value' => 0],
        ];

        foreach ($coupons as $coupon) {
            Coupon::firstOrCreate(
                ['name' => $coupon['name']],
                $coupon
            );
        }
    }
}
