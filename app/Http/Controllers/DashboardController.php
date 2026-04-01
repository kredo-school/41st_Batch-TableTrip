<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Reservation;
use App\Models\Purchased;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();


        $latest_reservations = $user->reservations()->with('restaurant')->latest()->take(5)->get();


        $cart_items = $user->cartItems()->with('product')->get();
        $totalPrice = $cart_items->sum(function($item) {
            return ($item->product->price ?? 0) * $item->quantity;
        });

    
        $favorite_restaurants = $user->favorite_restaurants; 
        $favorite_kits = $user->favorite_kits;

       
        $latest_purchased = $user->purchased()->with('product')->latest()->take(5)->get();

        return view('dashboard', compact(
            'latest_reservations', 
            'cart_items', 
            'totalPrice', 
            'favorite_restaurants', 
            'favorite_kits',
            'latest_purchased'
        ));
    }
}