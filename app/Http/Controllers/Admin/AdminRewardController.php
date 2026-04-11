<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PointHistory;

class AdminRewardController extends Controller
{
    public function dashboard()
    {
        return view('admin.rewards.dashboard');
    }

    public function pointHistory()
    {
        $pointHistories = PointHistory::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.rewards.point-history', compact('pointHistories'));
    }
}
