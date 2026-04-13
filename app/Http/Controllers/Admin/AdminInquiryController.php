<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerInquiry;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AdminInquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = CustomerInquiry::query();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $inquiries = $query
            ->orderByRaw("CASE WHEN status = 'flagged' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show($id)
    {
        $inquiry = CustomerInquiry::findOrFail($id);

        $matchedUser = User::where('email', $inquiry->email)->first();

        return view('admin.inquiries.show', compact('inquiry', 'matchedUser'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:open,replied,flagged',
        ]);

        $inquiry = CustomerInquiry::findOrFail($id);
        $inquiry->status = $request->status;
        $inquiry->save();

        return redirect()->back()->with('success', 'Inquiry status updated successfully.');
    }

    public function replyForm($id)
    {
        $inquiry = CustomerInquiry::findOrFail($id);

        $replySubject = 'Re: ' . $inquiry->subject;
        $matchedUser = User::where('email', $inquiry->email)->first();

        return view('admin.inquiries.reply', compact(
            'inquiry',
            'replySubject',
            'matchedUser'
        ));
    }
    public function sendReply(Request $request, $id)
    {
        $request->validate([
            'reply_message' => 'required|string|max:3000',
        ]);

        $inquiry = CustomerInquiry::findOrFail($id);

        Mail::raw($request->reply_message, function ($message) use ($inquiry) {
            $message->to($inquiry->email)
                    ->subject('Re: ' . $inquiry->subject);
        });

        $inquiry->status = 'replied';
        $inquiry->save();

        return redirect()
            ->route('admin.inquiries.show', $inquiry->id)
            ->with('success', 'Reply sent successfully.');
    }
}