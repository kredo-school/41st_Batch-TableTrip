<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;



class ForgetController extends Controller
{
    public function show(){
        return view('auth.forgot-password');
    }

   public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        return back()->with('status', 'We have emailed your password reset link');
    }
}