<?php

namespace App\Http\Controllers\User; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Inquiry;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\Reservation;

class InquiryController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();

        $threads = Inquiry::with('recipient')
            ->where(function($q) use ($userId) {
                $q->where('sender_id', $userId)
                  ->orWhere('recipient_id', $userId);
            })
            ->where('status', '!=', 'deleted')
            ->orderBy('created_at', 'desc') 
            ->get()                        
            ->unique('thread_id');          

        $restaurants = Restaurant::where('approval_status', 'approved')->get();

        return view('user.inquiry.dashboard', compact('threads', 'restaurants'));
    }

    /**
     * 予約一覧から遷移してきた時の処理
     */
    public function create(Request $request)
    {
        $userId = Auth::id();
        $restaurantId = $request->restaurant_id;
        $reservationId = $request->reservation_id;

        // 1. そのレストランとの既存スレッドがあるか確認
        $existingThread = Inquiry::where(function($q) use ($userId, $restaurantId) {
                $q->where('sender_id', $userId)->where('recipient_id', $restaurantId);
            })
            ->orWhere(function($q) use ($userId, $restaurantId) {
                $q->where('sender_id', $restaurantId)->where('recipient_id', $userId);
            })
            ->where('status', '!=', 'deleted')
            ->first();

        if ($existingThread) {
            return redirect()->route('user.inquiry.index', $existingThread->thread_id);
        }

        $targetRestaurant = Restaurant::findOrFail($restaurantId);
        $reservation = Reservation::find($reservationId);

        return view('user.inquiry.index', compact('targetRestaurant', 'reservation'));
    }

    public function index($thread_id)
    {
        $messages = Inquiry::where('thread_id', (string)$thread_id)
            ->orderBy('created_at', 'asc')
            ->get();

        if ($messages->isEmpty()) {
            return redirect()->route('user.inquiry.dashboard');
        }
        return view('user.inquiry.index', compact('messages', 'thread_id'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);

        if ($request->filled('thread_id')) {
            $threadId = $request->thread_id;
            $recipientId = $request->recipient_id;
            $recipientType = $request->recipient_type;
        } else {
            $threadId = 'TRD' . time() . rand(10, 99);
            
            if ($request->target_type === 'admin') {
                $recipientId = null;
                $recipientType = 'Admin';
            } else {
                $recipientId = $request->recipient_id;
                $recipientType = 'Owner';
            }
        }

        $subject = $request->filled('reservation_date') 
            ? 'Inquiry about Reservation (' . $request->reservation_date . ')' 
            : 'Inquiry';

        Inquiry::create([
            'thread_id'      => $threadId,
            'sender_id'      => Auth::id(),
            'sender_type'    => 'User',
            'recipient_id'   => $recipientId,
            'recipient_type' => $recipientType,
            'subject'        => $subject,
            'message'        => $request->message,
            'status'         => 'pending',
        ]);

        return redirect()->route('user.inquiry.index', $threadId)
            ->with('success', 'Your message has been sent successfully!!');
    }

    public function destroy($thread_id)
    {     
        Inquiry::where('thread_id', $thread_id)
            ->where(function($q) {
                $q->where('sender_id', Auth::id())
                ->orWhere('recipient_id', Auth::id());
            })
            ->update(['status' => 'deleted']);
        return redirect()->route('user.inquiry.dashboard')->with('success', 'History deleted.');
    }
}