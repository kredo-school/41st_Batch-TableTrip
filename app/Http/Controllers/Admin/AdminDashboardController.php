<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Inquiry;
use Carbon\Carbon;
use App\Models\Review;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $ordersPerDay = [];
        $labels = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);

            $labels[] = $date->format('D');

            $ordersPerDay[] = Order::whereDate('created_at', $date)->count();
        }

        $recentOrders = Order::latest()
            ->take(5)
            ->get();

        $openInquiryCount = Inquiry::where('recipient_type', 'admin')
            ->where('status', 'open')
            ->count();

        $reportedReviewsCount = Review::where('status', 'hidden')->count();

        return view('admin.dashboard', compact(
            'recentOrders',
            'labels',
            'ordersPerDay',
            'openInquiryCount',
            'reportedReviewsCount'
        ));
    }
}