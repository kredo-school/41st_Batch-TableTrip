<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
       $cart_items = Auth::user()->cartItems()->with('product')->get();
       return view('user.cart', compact('cart_items'));
    }

    public function destroy($id){

    }
}
