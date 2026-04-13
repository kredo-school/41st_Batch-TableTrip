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
}