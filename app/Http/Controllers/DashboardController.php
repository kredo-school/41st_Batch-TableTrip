<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Order; 
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();


        // point
        // $total_points = PointHistory::where('user_id', $user->id)->sum('points');

        // --- 1. upcoming reservation) ---
        $latest_reservations = $user->reservations()
            ->where('reservation_date', '>=', $today)
            ->with('restaurant')
            ->latest()
            ->take(5)
            ->get();

        // --- 2. cart ---
        $cart = session()->get('cart', []);
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += ($item['product']['price'] ?? 0) * $item['quantity'];
        }

        // --- favorite---
        $favorite_kits = $user->favorite_kits()->get();

        // history
        $purchased_items = Order::where('user_id', $user->id)
            ->with('product') 
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // ② reservationhistory
        $past_reservations = $user->reservations()
            ->where('reservation_date', '<', $today)
            ->with('restaurant')
            ->orderBy('reservation_date', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'latest_reservations', 
            'cart', 
            'totalPrice', 
            'favorite_kits',
            'purchased_items',
            'past_reservations'
        ));
    }
}