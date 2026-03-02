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
    // edit user
    public function edit(){
        $user =Auth::user();
        return view('user.edit',compact('user'));
    }

    // update user
    // public function update(){
    //     $user=Auth::user();

    //     $request->validate([
            
    //     ])


    //     return view('user.update',compact('user'));
    // }
}
