<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Review;
use App\Models\Reservation;
use App\Models\Notification;

class RestaurantController extends Controller
{

    public function show($id)
    {
        $restaurant = Restaurant::with('heroImage', 'galleryImage1', 'galleryImage2')
        ->findOrFail($id);

        if ($restaurant->approval_status !== 'approved' || $restaurant->status !== 'published') {
            return response()->view('restaurants.not_published', [], 403);
        }

        $menus = Menu::where('restaurant_id', $id)->get();
        $products = Product::where('restaurant_id', $id)->get();
        $reviews = Review::with(['user', 'replies'])
        ->where('restaurant_id', $id)
        ->where('comment_type', 'visit') // レストランレビューのみ取得
        ->whereNotNull('user_id') // ユーザーIDがnullでないレビューのみ取得
        ->whereNull('parent_id') // 親レビューのみ取得
        ->orderBy('created_at', 'desc')
        ->get();

        $isFavorite = Auth::check() ? $restaurant->favorites()->where('user_id', Auth::id())->exists() : false;
        $hasVisited = $restaurant->reservations()->where('user_id', Auth::id())->where('status', 'visited')->exists(); //can be used to check if user can write review or not
        $hasReviewed = $restaurant->reviews()->where('user_id', Auth::id())->where('comment_type', 'visit')->exists(); //can be used to check if user can write review or not

        return view('restaurants.restaurant_page', compact('restaurant', 'menus', 'products', 'reviews', 'isFavorite', 'hasVisited', 'hasReviewed'));
    }

    public function store(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $user = Auth::user(); // ログインユーザー

        $request->validate([
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required',
            'number_of_people' => 'required|integer|min:1',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'special_requests' => 'nullable|string|max:1000',
        ]);

        $reservation = $restaurant->reservations()->create([
            'restaurant_id' => $restaurant->id,
            'user_id' => $user ? $user->id : null,
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'number_of_people' => $request->number_of_people,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'special_requests' => $request->special_requests,
            'status' => 'pending', // デフォルトのステータスを設定
        ]);

        Notification::create([
            'recipient_id' => $restaurant->id,
            'recipient_type' => Restaurant::class,
            'title' => '[Reservation] New Booking received',
            'message' => 'You have a new reservation.',
            'target_type' => Reservation::class,
            'target_id' => $reservation->id,
            'is_action_required' => true,
            'is_completed' => false,
        ]);

        return redirect()->back()->with('success', 'Your reservation has been made successfully!');
    }

   public function favoriteToggle($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $favorite = $restaurant->favorites()->where('user_id', $user->id)->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            $restaurant->favorites()->create([
                'user_id' => $user->id
            ]);
        }

        return back();
    }

    public function storeReview(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $request->validate([
            'rating' => 'nullable|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        Review::create([
            'restaurant_id' => $restaurant->id,
            'user_id' => $user->id,
            'author_type' => 'user',
            'rating' => $request->rating,
            'comment' => $request->comment,
            'comment_type' => 'visit',
            'is_approved' => true, 
        ]);

        return redirect()->back()->with('success', 'Your review has been submitted successfully!');
    }


}
