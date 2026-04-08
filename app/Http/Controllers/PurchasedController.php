<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchased; 
use Illuminate\Support\Facades\Auth; 

class PurchasedController extends Controller
{
    public function index()
    {
        $purchased = Purchased::where('user_id', Auth::id())
            ->with('product')
            ->orderBy('ordered_at', 'desc')
            ->get();
        return view('user.purchased.index', compact('purchased'));
    }
}