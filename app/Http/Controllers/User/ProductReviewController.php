<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Models\Purchased;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    public function index($id)
    {
        $product = Product::findOrFail($id);

        $reviews = Review::with('user')
            ->where('product_id', $id)
            ->where('status', 'visible')
            ->orderBy('created_at', 'desc')
            ->get();

        $avgRating = $reviews->avg('rating') ?? 0;

        // 購入済みかチェック
        $hasPurchased = Auth::check()
            ? Purchased::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->exists()
            : false;

        // 既にレビュー済みかチェック
        $hasReviewed = Auth::check()
            ? Review::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->exists()
            : false;

        return view('products.reviews', compact('product', 'reviews', 'avgRating', 'hasPurchased', 'hasReviewed'));
    }

    public function store(Request $request, $id)
    {
        // 購入済みかチェック
        $hasPurchased = Purchased::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->exists();

        if (!$hasPurchased) {
            return redirect()->route('products.reviews', $id)
                ->with('error', 'Only customers who purchased this product can write a review.');
        }

        // 既にレビュー済みかチェック
        $hasReviewed = Review::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->exists();

        if ($hasReviewed) {
            return redirect()->route('products.reviews', $id)
                ->with('error', 'You have already submitted a review for this product.');
        }

        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $product = Product::findOrFail($id);

        Review::create([
            'user_id'       => Auth::id(),
            'product_id'    => $product->id,
            'restaurant_id' => $product->restaurant_id,
            'rating'        => $request->rating,
            'comment'       => $request->comment,
        ]);

        return redirect()->route('products.reviews', $id)->with('success', 'Your review has been submitted!');
    }
}
