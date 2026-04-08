<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $owner = Auth::guard('restaurant')->user();
        $reviews = Review::with(['user', 'replies'])
        ->where('restaurant_id', $owner->id)
        ->whereNotNull('user_id') // ユーザーIDがnullでないレビューのみ取得
        ->whereNull('parent_id') // 親レビューのみ取得
        ->orderBy('created_at', 'desc')
        ->paginate(5);

        return view('restaurant-owners.review.index', compact('reviews'));
    }

    public function reply(Request $request, $id)
    {
        $owner = Auth::guard('restaurant')->user();
        $parentReview = Review::findOrFail($id);

        // バリデーション
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        // 返信の作成
        Review::create([
            'restaurant_id' => $owner->id,
            'user_id' => null,
            'product_id' => $parentReview->product_id,
            'parent_id' => $parentReview->id,
            'author_type' => 'restaurant',
            'comment_type' => $parentReview->comment_type,
            'comment' => $request->comment,
            'rating' => null,
            'is_approved' => true,
            'ai_score' => null,
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Reply posted successfully.');
    }
}
