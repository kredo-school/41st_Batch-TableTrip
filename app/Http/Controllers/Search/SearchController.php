<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Restaurant;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        if($keyword){
            // restaurants results
            $restaurants = Restaurant::where('restaurant_name', 'LIKE', "%{{$keyword}}%")
                                ->orWhere('description', 'LIKE', "%{$keyword}%")
                                ->get();

            // mealkit results
            $products = Product::where('name', 'LIKE', "%{$keyword}%")
                                ->orWhere('description', 'LIKE', "%{$keyword}%")
                                ->get();
        }else{
            $restaurants =collect();
            $products = collect();
        }
        return view('search.results', compact('restaurants', 'products', 'keyword'));
    }
}
