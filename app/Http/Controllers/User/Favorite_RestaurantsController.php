<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Favorite_RestaurantsController extends Controller
{
public function index()
    {
        $user = Auth::user();
        $favorite_restaurants = $user->favorite_restaurants()->get();

        return view('user.favorite_restaurants', compact('favorite_restaurants'));
    }
}