<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\User; 
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    public function index(){
       return redirect()->route('cart.index');
    }

    public function destroy($id){
    }
}
