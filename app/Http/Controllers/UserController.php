<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // illustrate user
    public function show(){
        $user = Auth::user();
        return view('user.show',compact('user'));
    }
}
