<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::first();

        // ポイント履歴
        for ($i = 1; $i <= 10; $i++) {
            \App\Models\PointHistory::create([
                'user_id' => $user->id,
                'points' => rand(10, 100),
                'type' => 'purchase',
                'description' => 'Order #' . $i,
            ]);
        }

        // クーポン
        $coupon = \App\Models\Coupon::create([
            'name' => 'Welcome 10% OFF',
            'discount_percent' => 10,
            'start_date' => now(),
            'end_date' => now()->addMonth(),
        ]);

        // ユーザーに付与
        $user->coupons()->attach($coupon->id);

        // スタンプ
        $prefectures = ['Osaka', 'Tokyo', 'Kyoto'];

        foreach ($prefectures as $pref) {
            \App\Models\PrefectureStamp::create([
                'user_id' => $user->id,
                'prefecture' => $pref,
                'earned_at' => now(),
            ]);
        }
    }
}