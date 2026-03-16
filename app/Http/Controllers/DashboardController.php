<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Reservation;

class DashboardController extends Controller

{
  // DashboardController.php  

public function index(Request $request)
{
    $user = Auth::user();
    $tab = $request->query('tab', 'restaurants');

    $latest_reservations = $user->reservations()->with('restaurant')->latest()->take(5)->get();
    $cart_items = $user->cartItems()->with('product')->get();
    $totalPrice = $cart_items->sum(function($item) {
        return $item->product->price * $item->quantity;
    });


    $favorite_restaurants = $user->favorite_restaurants()->get();
    $favorite_kits = $user->favorite_kits()->with('product')->get();

    return view('dashboard', compact(
        'latest_reservations', 'cart_items', 'totalPrice', 'favorite_restaurants', 'favorite_kits' 
    ));
}}

