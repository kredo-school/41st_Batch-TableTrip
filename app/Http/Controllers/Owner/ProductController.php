<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request){

        $categories = Category::orderBy('name')->get();

        $owner = Auth::guard('restaurant')->user();

        $query = Product::where('restaurant_id',$owner->id);

        if($request->filled('search')){
            $keyword = trim($request->search);
            $query->where('name','like','%'.$keyword.'%');
        }

        if ($request->filled('status')) {

            switch ($request->status) {

                case 'active':
                    $query->where('stock', '>', 5)
                        ->where('is_visible', true);
                    break;

                case 'low_stock':
                    $query->where('stock', '<=', 5)
                        ->where('stock', '>', 0)
                        ->where('is_visible', true);
                    break;

                case 'sold_out':
                    $query->where('stock', 0)
                        ->where('is_visible', true);
                    break;

                case 'hide':
                    $query->where('is_visible', false);
                    break;
            }
        }

        if($request->filled('category_id')){
            $query->where('category_id',$request->category_id);
        }

        $products = $query
        ->orderBy('updated_at','desc')
        ->orderBy('created_at','desc')
        ->paginate(5)
        ->withQueryString(); //paginateしても検索条件保持

        return view('restaurant-owners.meal_kits.index',compact('categories','products'));
    }

    public function toggleVisibility($id)
{
    $product = Product::findOrFail($id);
    $product->is_visible = !$product->is_visible;
    $product->save();

    return back();
}
}
