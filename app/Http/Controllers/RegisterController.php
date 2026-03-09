<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    //illuslate register 
    public function show(){
        return view('user.register');
    }

    // register user
          public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'user_name'   => 'required|string|max:255|unique:users,user_name',
            'tel'         => 'required|string|max:20',
            'email'       => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'postal_code' => 'nullable|string|max:10',
            'address'     => 'nullable|string|max:255',
            'country'     => 'required|string|max:100',
        ]);

        $user = User::create([
            'first_name'  => $validated['first_name'],
            'last_name'   => $validated['last_name'],
            'user_name'   => $validated['user_name'],
            'tel'         => $validated['tel'],
            'email'       => $validated['email'],
            'password'    => Hash::make($validated['password']),
            'postal_code' => $validated['postal_code'] ?? null,
            'address'     => $validated['address'] ?? null,
            'country'     => $validated['country'],
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
