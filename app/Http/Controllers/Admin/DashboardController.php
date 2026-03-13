<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
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

        return view('admin.dashboard', compact(
            'recentOrders',
            'labels',
            'ordersPerDay'
        ));
}
}