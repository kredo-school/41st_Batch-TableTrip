<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class Favorite_KitsController extends Controller
{
    public function index()
{
    $user = Auth::user();
    
    $favorite_kits = $user->favorite_kits()->with('product')->get();
    return view('favorite_kits', compact('favorite_kits'));
}
}
