<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'restaurant'])
            ->latest()
            ->paginate(10);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function show($id)
    {
        $review = Review::with(['user', 'restaurant'])->findOrFail($id);

        return view('admin.reviews.show', compact('review'));
    }

    public function updateStatus(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $request->validate([
            'status' => 'required|in:visible,hidden,flagged',
        ]);

        $review->status = $request->status;
        $review->save();

        return redirect()
            ->route('admin.reviews.show', $review->id)
            ->with('success', 'Review status updated successfully.');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()
            ->route('admin.reviews.index')
            ->with('success', 'Review deleted successfully.');
    }
}
