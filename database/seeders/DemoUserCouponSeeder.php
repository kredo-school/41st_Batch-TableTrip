<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;

class DemoUserCouponSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('is_admin', false)->get();

        $welcome = Coupon::where('name', 'Welcome 10% OFF')->first();
        $silver  = Coupon::where('name', 'Silver Rank Reward 10% OFF')->first();
        $gold    = Coupon::where('name', 'Gold Rank Reward 15% OFF')->first();
        $diamond = Coupon::where('name', 'Diamond Rank Reward 20% OFF')->first();
        $stamp8  = Coupon::where('name', '5% OFF (8 Stamps)')->first();
        $stamp16 = Coupon::where('name', '10% OFF (16 Stamps)')->first();
        $stamp24 = Coupon::where('name', '15% OFF (24 Stamps)')->first();
        $stamp32 = Coupon::where('name', '20% OFF (32 Stamps)')->first();
        $stamp40 = Coupon::where('name', '25% OFF (40 Stamps)')->first();
        $stamp47 = Coupon::where('name', '50% OFF (47 Stamps)')->first();
        $freeMealKit = Coupon::where('name', 'Free Meal Kit')->first();
        $freeShipping = Coupon::where('name', 'Free Shipping')->first();

        foreach ($users as $user) {

            // Welcome 全員
            if ($welcome) {
                DB::table('user_coupons')->insert([
                    'user_id' => $user->id,
                    'coupon_id' => $welcome->id,
                    'is_used' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Rank別
            if ($user->rank === 'silver' && $silver) {
                DB::table('user_coupons')->insert([
                    'user_id' => $user->id,
                    'coupon_id' => $silver->id,
                    'is_used' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            if ($user->rank === 'gold' && $gold) {
                DB::table('user_coupons')->insert([
                    'user_id' => $user->id,
                    'coupon_id' => $gold->id,
                    'is_used' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            if ($user->rank === 'diamond' && $diamond) {
                DB::table('user_coupons')->insert([
                    'user_id' => $user->id,
                    'coupon_id' => $diamond->id,
                    'is_used' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $stampCount = DB::table('prefecture_stamps')
                ->where('user_id', $user->id)
                ->count();

            $stampRewards = [
                8  => $stamp8,
                16 => $stamp16,
                24 => $stamp24,
                32 => $stamp32,
                40 => $stamp40,
            ];

            foreach ($stampRewards as $requiredCount => $coupon) {
                if ($stampCount >= $requiredCount && $coupon) {
                    DB::table('user_coupons')->insert([
                        'user_id' => $user->id,
                        'coupon_id' => $coupon->id,
                        'is_used' => false,
                        'expires_at' => now()->addDays(30),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            if ($stampCount >= 47) {
                foreach ([$stamp47, $freeMealKit, $freeShipping] as $coupon) {
                    if ($coupon) {
                        DB::table('user_coupons')->insert([
                            'user_id' => $user->id,
                            'coupon_id' => $coupon->id,
                            'is_used' => false,
                            'expires_at' => now()->addDays(30),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }

                $user->update(['rank' => 'diamond']);
            }
        }
    }
}