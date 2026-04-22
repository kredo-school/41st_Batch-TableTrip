<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\PrefectureStamp;
use App\Models\Coupon;
use App\Models\UserCoupon;

class AdminReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::latest()->paginate(10);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function show($id)
    {
        $reservation = Reservation::with('user', 'restaurant')->findOrFail($id);

        return view('admin.reservations.show', compact('reservation'));
    }

    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::with('restaurant', 'user')->findOrFail($id);

        $reservation->status = $request->status;

        if ($request->status === 'visited') {
            $reservation->visited_at = now();
        }

        $reservation->save();

        // ⭐ここから追加
        if ($request->status === 'visited' && $reservation->user_id && $reservation->restaurant) {

            $prefecture = $reservation->restaurant->prefecture;

            // スタンプ付与（1県1回）
            $stamp = PrefectureStamp::firstOrCreate(
                [
                    'user_id' => $reservation->user_id,
                    'prefecture' => $prefecture,
                ],
                [
                    'earned_at' => now(),
                ]
            );

            // 現在のスタンプ数
            $stampCount = PrefectureStamp::where('user_id', $reservation->user_id)->count();

            // 🎯 マイルストーン報酬
            $milestoneCoupons = [
                8  => '5% OFF (8 Stamps)',
                16 => '10% OFF (16 Stamps)',
                24 => '15% OFF (24 Stamps)',
                32 => '20% OFF (32 Stamps)',
                40 => '25% OFF (40 Stamps)',
            ];

            foreach ($milestoneCoupons as $count => $couponName) {
                if ($stampCount >= $count) {

                    $coupon = Coupon::where('name', $couponName)->first();

                    if ($coupon) {
                        $alreadyIssued = UserCoupon::where('user_id', $reservation->user_id)
                            ->where('coupon_id', $coupon->id)
                            ->exists();

                        if (! $alreadyIssued) {
                            UserCoupon::create([
                                'user_id' => $reservation->user_id,
                                'coupon_id' => $coupon->id,
                                'is_used' => false,
                                'expires_at' => now()->addDays(30),
                            ]);
                        }
                    }
                }
            }

            // 🎯 47都道府県達成
            if ($stampCount >= 47) {

                $user = $reservation->user;

                if ($user && $user->rank !== 'diamond') {
                    $user->rank = 'diamond';
                    $user->save();
                }

                $finalRewards = [
                    '50% OFF (47 Stamps)',
                    'Free Meal Kit',
                    'Free Shipping',
                ];

                foreach ($finalRewards as $couponName) {
                    $coupon = Coupon::where('name', $couponName)->first();

                    if ($coupon) {
                        $alreadyIssued = UserCoupon::where('user_id', $reservation->user_id)
                            ->where('coupon_id', $coupon->id)
                            ->exists();

                        if (! $alreadyIssued) {
                            UserCoupon::create([
                                'user_id' => $reservation->user_id,
                                'coupon_id' => $coupon->id,
                                'is_used' => false,
                                'expires_at' => now()->addDays(30),
                            ]);
                        }
                    }
                }
            }
        }

        return back()->with('success', 'Reservation status updated.');
    }
}