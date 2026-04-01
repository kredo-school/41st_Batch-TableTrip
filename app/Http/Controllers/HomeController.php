<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        $featured_restaurants = Restaurant::take(8)->get(); 
        $featured_products = \App\Models\Product::take(8)->get();

        return view('welcome', compact('featured_restaurants', 'featured_products'));
    }
}