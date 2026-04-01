<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;


class ForgetController extends Controller
{
    public function show(){
        return view('auth.forgot-password');
    }

    public function store(){
        $request->validate(['email'=>'required|email']);
        return back()->with('status','We have emailed your password reset link');
    }

}
