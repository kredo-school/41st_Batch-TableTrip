<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
    use App\Models\CustomerInquiry;

class AdminInquiryController extends Controller
{

    public function index()
    {
        $inquiries = CustomerInquiry::latest()->get();

        return view('admin.inquiries.index', compact('inquiries'));
    }
}
