<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchased;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class PurchasedController extends Controller
{
    public function index()
{
    $user_id = Auth::id();

    $purchased = Purchased::where('user_id', $user_id)
        ->with('product')
        ->orderBy('ordered_at', 'desc')
        ->get();

    $upcoming_reservations = Reservation::where('user_id', $user_id)
        ->whereDate('reservation_date', '>=', now())
        ->with('restaurant')
        ->orderBy('reservation_date', 'asc')
        ->get();

    $past_reservations = Reservation::where('user_id', $user_id)
        ->whereDate('reservation_date', '<', now())
        ->with('restaurant')
        ->orderBy('reservation_date', 'desc')
        ->get();

    $reviewedProductIds = Review::where('user_id', $user_id)
        ->pluck('product_id')
        ->toArray();

    return view('user.purchased.index', compact(
        'purchased',
        'upcoming_reservations',
        'past_reservations',
        'reviewedProductIds'
    ));
}
}