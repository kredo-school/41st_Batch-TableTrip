<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request){

        $owner = Auth::guard('restaurant')->user();

        


        return view('restaurant-owners.meal_kits.index');
    }
}
