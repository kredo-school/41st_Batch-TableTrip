<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class DashboardController extends Controller

{
  // DashboardController.php  

public function index() {
    $user = Auth::user();
 
    // indicate reservation lists
    $latest_reservations=$user->reservations()
        ->with('restaurant')
        ->orderBy('reservation_date','asc')
        ->take(4)
        ->get();

    $cart_items = $user->cartItems()->with('product')->get();
    $totalPrice = $cart_items->sum(fn($item) => ($item->product->price ?? 0) * $item->quantity);

    return view('dashboard', [
        'latest_reservations' => $latest_reservations, 
        'cart_items' => $cart_items,
        'totalPrice' => $totalPrice,
    ]);
}}