<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $ordersPerDay = [];
        $labels = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = Carbon::now('Asia/Tokyo')->subDays($i);

            $start = $date->copy()->startOfDay()->timezone('UTC');
            $end = $date->copy()->endOfDay()->timezone('UTC');

            $labels[] = $date->format('D');

            $ordersPerDay[] = Order::whereBetween('created_at', [
                $start,
                $end
            ])->sum('total_price');
        }

        $recentOrders = Order::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'recentOrders',
            'labels',
            'ordersPerDay'
        ));
}
}