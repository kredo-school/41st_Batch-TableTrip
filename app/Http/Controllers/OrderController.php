<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\Purchased;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_visible', true);

        // Favorites tab
        if ($request->tab === 'favorites' && Auth::check()) {
            $favIds = Favorite::where('user_id', Auth::id())->pluck('product_id');
            $query->whereIn('id', $favIds);
        }

        // Price filter
        if ($request->filled('price_max')) {
            $query->where('price', '<=', (int) $request->price_max);
        }

        // Rating filter
        if ($request->filled('ratings')) {
            $query->whereIn(\DB::raw('FLOOR(rating)'), $request->ratings);
        }

        // Location filter
        if ($request->filled('locations')) {
            $query->whereIn('location', $request->locations);
        }

        // Category filter
        if ($request->filled('categories')) {
            $query->whereIn('category_id', $request->categories);
        }

        // Sort
        switch ($request->sort) {
            case 'price_asc':  $query->orderBy('price', 'asc');   break;
            case 'price_desc': $query->orderBy('price', 'desc');  break;
            case 'rating':     $query->orderBy('rating', 'desc'); break;
            default:           $query->orderBy('id', 'desc');     break;
        }

        $products    = $query->withCount('reviews')->withAvg('reviews', 'rating')->get();
        $categories  = \App\Models\Category::all();
        $locations   = Product::where('is_visible', true)->distinct()->pluck('location')->sort()->values();
        $priceMax    = Product::where('is_visible', true)->max('price') ?? 10000;

        $favoriteIds = Auth::check()
            ? Favorite::where('user_id', Auth::id())->pluck('product_id')->toArray()
            : [];

        return view('products.index', compact('products', 'favoriteIds', 'categories', 'locations', 'priceMax'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        $reviews = Review::with('user')
            ->where('product_id', $id)
            ->where('status', 'visible')
            ->orderBy('created_at', 'desc')
            ->get();

        $avgRating = $reviews->avg('rating') ?? 0;

        $hasPurchased = Auth::check()
            ? Purchased::where('user_id', Auth::id())->where('product_id', $id)->exists()
            : false;

        $hasReviewed = Auth::check()
            ? Review::where('user_id', Auth::id())->where('product_id', $id)->exists()
            : false;

        return view('products.show', compact('product', 'reviews', 'avgRating', 'hasPurchased', 'hasReviewed'));
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