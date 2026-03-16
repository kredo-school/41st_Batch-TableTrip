<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Favorite_RestaurantsController extends Controller
{
public function index()
    {
        $user = Auth::user();
        $favorite_restaurants = $user->favorite_restaurants()->get();

        return view('favorite_restaurants', compact('favorite_restaurants'));
    }
}