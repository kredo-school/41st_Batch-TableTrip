<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth; 

class OrderController extends Controller
{
    public function index()
    {
        $products    = Product::all();
        $favoriteIds = Auth::check()
            ? Favorite::where('user_id', Auth::id())->pluck('product_id')->toArray()
            : [];

        return view('products.index', compact('products', 'favoriteIds'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    public function showDetails()
    {
        $product = Product::first();

        return view('products.order_details', compact('product'));
    }

    public function create()
    {
        // resources/views/products/create.blade.php を表示する
        return view('products.create');
    }

    public function store(Request $request)
    {
        // ① バリデーション
        $request->validate([
            'name'            => 'required',
            'restaurant_name' => 'required',
            'location'        => 'required',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // ② 画像保存
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // ③ DB保存（image_path を追加）
        Product::create([
            'name'            => $request->name,
            'category_id'     => 1,
            'restaurant_name' => $request->restaurant_name,
            'location'        => $request->location,
            'price'           => $request->price,
            'ingredients'     => $request->ingredients ?? 'No data',
            'allergens'       => $request->allergens,
            'description'     => $request->description,
            'image'           => $imagePath,
            'badge'           => $request->badge,
            'tag'             => $request->tag,
        ]);

        return redirect()->route('products.index')->with('success', 'Product registered successfully!');
    }

}