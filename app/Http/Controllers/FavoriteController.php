<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
    {
        $userId    = Auth::id();
        $productId = $request->product_id;

        $existing = Favorite::where('user_id', $userId)
                            ->where('product_id', $productId)
                            ->first();

        if ($existing) {
            $existing->delete();
        } else {
            Favorite::create([
                'user_id'    => $userId,
                'product_id' => $productId,
            ]);
        }

        return back();
    }

    public function index()
    {
        $products = Auth::user()
                        ->favorites()
                        ->with('product')
                        ->get()
                        ->pluck('product');

        return view('products.favorites', compact('products'));
    }
}
