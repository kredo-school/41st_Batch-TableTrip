<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

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

  public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());

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

        $user->first_name  = $request->first_name;
        $user->last_name   = $request->last_name;
        $user->user_name   = $request->user_name;
        $user->email       = $request->email;
        $user->tel         = $request->tel;
        $user->postal_code = $request->postal_code;
        $user->address     = $request->address;
        $user->country     = $request->country;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        if ($request->hasFile('profile_picture')) {
  
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

  
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();


        return redirect('/dashboard')->with('success', 'Your profile has been updated!');
    }

   public function destroy()
{
    $userId = Auth::id();
    $user = User::findOrFail($userId); 

    if ($user->profile_picture) {
        Storage::disk('public')->delete($user->profile_picture);
    }
    $user->delete();


    Auth::logout();

    return redirect('/')->with('success', 'Your account has been deleted.');
}
/**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully!');
    }
}