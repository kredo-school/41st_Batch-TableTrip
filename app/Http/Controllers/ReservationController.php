<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Order; 
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index(Request $request)
{
    $user = Auth::user();
    $today = \Carbon\Carbon::today()->toDateString();

    $latest_reservations = Reservation::where('user_id', $user->id)
        ->where('reservation_date', '>=', $today)
        ->with('restaurant')
        ->get();

    $past_reservations = Reservation::where('user_id', $user->id)
        ->where('reservation_date', '<', $today)
        ->with('restaurant')
        ->latest()
        ->take(5)
        ->get();


    $purchased_items = \App\Models\Order::where('user_id', $user->id)
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard', compact(
        'latest_reservations',
        'past_reservations',
        'purchased_items'
    ));
}
}