<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Show registration form
     */
    public function show()
    {
        return view('user.register');
    }

    /**
     * Handle registration request
     */
    public function store(Request $request)
    {
        // 1. Validate inputs
        $validated = $request->validate([
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'user_name'       => 'required|string|max:255|unique:users,user_name',
            'tel'             => 'required|string|max:20',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|confirmed|min:8',
            'postal_code'     => 'nullable|string|max:10',
            'address'         => 'nullable|string|max:255',
            'country'         => 'required|string|max:100',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Handle Profile Picture upload
        $path = null;
        if ($request->hasFile('profile_picture')) {
            // Save file to storage/app/public/profiles
            $path = $request->file('profile_picture')->store('profiles', 'public');
        }

        // 3. Create User in Database
        $user = User::create([
            'first_name'      => $validated['first_name'],
            'last_name'       => $validated['last_name'],
            'user_name'       => $validated['user_name'],
            'tel'             => $validated['tel'],
            'email'           => $validated['email'],
            'password'        => Hash::make($validated['password']),
            'postal_code'     => $validated['postal_code'] ?? null,
            'address'         => $validated['address'] ?? null,
            'country'         => $validated['country'],
            'profile_picture' => $path, 
        ]);

        // 4. Auto login and redirect to dashboard
        Auth::login($user);

        return redirect()->route('dashboard')->with('status', 'Welcome to TableTrip!');
    }
}