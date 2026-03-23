<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavoriteKitsController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $favorite_kits = $user->favorite_kits()->with('product')->get();
    return view('user.favoritekits', compact('favoritekits'));
}
}
