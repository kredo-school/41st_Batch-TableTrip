<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Purchased; 
use Illuminate\Support\Facades\Auth; 

class PurchasedController extends Controller
{
    public function index()
    {
    
        $purchased = Purchased::with('meal_kit')
            ->where('user_id', Auth::id()) 
            ->orderBy('ordered_at', 'desc') 
            ->get();

        return view('user.purchased.index', compact('purchased'));
    }
}