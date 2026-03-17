<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    // illustrate user
    public function show(){
    $user = Auth::user();
    return redirect()->route('dashboard')->with('success', 'Your profile has been updated!');
}
    // edit user
    public function edit(){
        $user =Auth::user();
        return view('user.edit',compact('user'));
    }

    // update user
   public function update(Request $request)
    {
        // ensure we have an Eloquent User model (so save() is available)
        $user = \App\Models\User::findOrFail(Auth::id());

        $request->validate([
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'user_name'       => 'required|string|max:255|unique:users,user_name,' . $user->id,
            'email'           => 'required|email|unique:users,email,' . $user->id,
            'tel'             => 'required|string|max:20', 
            'postal_code'     => 'required|string|max:10', 
            'address'         => 'required|string|max:255', 
            'country'         => 'required|string|max:100', 
            'password'        => 'nullable|min:8', 
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->user_name  = $request->user_name;
        $user->email      = $request->email;
        $user->tel        = $request->tel;
        $user->postal_code = $request->postal_code;
        $user->address    = $request->address;
        $user->country    = $request->country;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();  

        return redirect('/mypage')->with('success', 'Your profile has been updated!');
    }

    // delete user
    public function destroy()
    {

        // retrieve the Eloquent User model instance to ensure delete() is available
        $user = \App\Models\User::find(Auth::id());
        if ($user) {
            Auth::logout(); // logout before deleting the record
            $user->delete(); // delete user record
            return redirect('/')->with('success', 'Your account has been deleted.');
        }

        // if no user found, ensure logout and redirect
        Auth::logout();
        return redirect('/')->with('error', 'User not found.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have successfully logged out!');
    }

}