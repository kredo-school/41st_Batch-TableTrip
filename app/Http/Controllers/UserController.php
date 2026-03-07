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
    public function update(Request $request){
        $user=Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        $user->update($request->only('name','email'));
        return redirect ('/mypage')->with('succuess','Your profile has been updated!');
    }

    // delete user
    public function destroy(){
        $user=Auth::user();
        Auth::logout(); //logout
        $user->delete(); //delete
    return redirect('/');//back to top
    }
}
