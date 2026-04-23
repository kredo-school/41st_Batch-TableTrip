<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PointHistory;
use App\Models\User;
use App\Models\UserCoupon;

class AdminRewardController extends Controller
{
    public function dashboard()
    {
        $totalPointsIssued = PointHistory::sum('points');
        $rewardUsers = User::count();

        $welcomeCouponsIssued = UserCoupon::whereHas('coupon', function ($query) {
            $query->where('name', 'Welcome Coupon');
        })->count();

        $stampRallyCompleted = 0; // 仮

        $bronzeCount = User::where('rank', 'bronze')->count();
        $silverCount = User::where('rank', 'silver')->count();
        $goldCount = User::where('rank', 'gold')->count();
        $diamondCount = User::where('rank', 'diamond')->count();

        $recentPointHistories = PointHistory::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.rewards.dashboard', compact(
            'totalPointsIssued',
            'rewardUsers',
            'welcomeCouponsIssued',
            'stampRallyCompleted',
            'bronzeCount',
            'silverCount',
            'goldCount',
            'diamondCount',
            'recentPointHistories'
        ));
    }

    public function pointHistory()
    {
        $pointHistories = PointHistory::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.rewards.point-history', compact('pointHistories'));
    }

    public function coupons()
    {
        $coupons = UserCoupon::with(['user', 'coupon'])
            ->latest()
            ->get();

        foreach ($coupons as $item) {

            if ($item->is_used) {
                $item->status = 'used';

            } elseif ($item->expires_at && $item->expires_at < now()) {
                $item->status = 'expired';

            } else {
                $item->status = 'unused';
            }
        }

        return view('admin.rewards.coupons', compact('coupons'));
    }

    public function stamps()
    {
        $users = User::withCount('stamps')
            ->get();

        foreach ($users as $user) {
            $user->stamp_count = $user->stamps_count;

            if ($user->stamp_count >= 47) {
                $user->status = 'completed';
            } else {
                $user->status = 'in-progress';
            }
        }

        return view('admin.rewards.stamps', compact('users'));
    }

    public function show($id)
    {
        $user = User::with('stamps')->findOrFail($id);

        return view('admin.rewards.stamps.show', compact('user'));
    }
}