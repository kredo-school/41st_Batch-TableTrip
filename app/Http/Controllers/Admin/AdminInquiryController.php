<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;

class AdminInquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inquiry::where(function($q) {
            $q->where('recipient_type', 'admin')
            ->orWhere('sender_type', 'admin');
        });

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $inquiries = $query
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('thread_id')
            ->map(function ($thread) {
                return $thread->sortByDesc('created_at')->first();
            });

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show($thread_id)
    {
        $messages = Inquiry::where('thread_id', $thread_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.inquiries.show', compact('messages'));
    }

    public function updateStatus(Request $request, $thread_id)
    {
        $request->validate([
            'status' => 'required|in:pending,replied,flagged',
        ]);

        // thread全体更新
        Inquiry::where('thread_id', $thread_id)
            ->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status updated.');
    }
}