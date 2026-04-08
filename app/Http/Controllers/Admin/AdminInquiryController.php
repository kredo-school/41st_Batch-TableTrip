<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerInquiry;
use App\Models\User;

class AdminInquiryController extends Controller
{
    public function index()
    {
        $inquiries = CustomerInquiry::latest()->get();

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show($id)
    {
        $inquiry = CustomerInquiry::findOrFail($id);

        $matchedUser = User::where('email', $inquiry->email)->first();

        return view('admin.inquiries.show', compact('inquiry', 'matchedUser'));
    }
}