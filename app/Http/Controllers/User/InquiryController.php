<?php

namespace App\Http\Controllers\User; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Inquiry;
use App\Models\Restaurant;
use App\Models\User;

class InquiryController extends Controller
{
   public function dashboard()
{
    $userId = Auth::id();

    $threads = Inquiry::where('sender_id', $userId)
            ->orWhere('recipient_id', $userId)
            ->with('recipient') // リレーションをロード
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique('thread_id');
    $restaurants = Restaurant::where('approval_status', 'approved')->get(); 

    return view('user.inquiry.dashboard', compact('threads', 'restaurants'));
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

    /**
     * Sending message
     */
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

        // save the data
        Inquiry::create([
            'thread_id'      => $threadId,
            'sender_id'      => Auth::id(),
            'sender_type'    => 'User',
            'recipient_id'   => $recipientId,
            'recipient_type' => $recipientType,
            'subject'        => 'Inquiry',
            'message'        => $request->message,
            'status'         => 'pending',
        ]);

        return redirect()->route('user.inquiry.show', $threadId)
            ->with('success', 'Your message has been sent successfully!!');
    }
}