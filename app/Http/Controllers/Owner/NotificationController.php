<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\Restaurant;

class NotificationController extends Controller
{
        public function index()
        {
            $owner = Auth::guard('restaurant')->user();
            $restaurant = Restaurant::findOrFail($owner->id);
            $notifications = Notification::with('target')
            ->where('recipient_id', $owner->id)
            ->where('recipient_type', Restaurant::class)
            ->latest('id')
            ->get();
    
            return view('restaurant-owners.notifications.index', compact('notifications'));
        }
    
        public function markAsRead($id)
        {
            $owner = Auth::guard('restaurant')->user();
            $restaurant = Restaurant::findOrFail($owner->id);
            $notification = $restaurant->notifications()->findOrFail($id);

            $notification->update([
                'is_completed' => true
            ]);

            return response()->json([
                'success' => true
            ]);
        }

       
}
