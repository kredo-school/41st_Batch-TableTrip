<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class RestaurantAuthController extends Controller
{
    public function create(){
        return view('restaurant-owners.register');
    }

    public function store(Request $request){

        $validated = $request->validate([
            'restaurant_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:restaurants,email',
            'phone' => 'nullable|string|max:255',
            'prefecture' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address_line' => 'required|string|max:255',
            'opening_hours' => 'nullable|string',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'password' => 'required|string|min:8|confirmed'
        ]);

         $restaurant = Restaurant::create([
            'restaurant_name' => $validated['restaurant_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'prefecture' => $validated['prefecture'],
            'city' => $validated['city'],
            'address_line' => $validated['address_line'],
            'opening_hours' => $validated['opening_hours'] ?? null,
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'password' => Hash::make($validated['password']),
            'approval_status' => 'draft',
        ]);

        return redirect()->route('owner.register')
        ->with('success', 'Your registration request has been submitted and is awaiting admin approval.');
    }

    public function showLoginForm(){
        return view('restaurant-owners.login');
    }

    public function login(Request $request){
        
        $credentials = $request->validate([
            'email'=> ['required','email'],
            'password'=>['required'],
        ]);

        $credentials['approval_status'] = 'approved';

        if(Auth::guard('restaurant')->attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->route('owner.dashboard'); 
        }

        return back()->withErrors([
            'email'=>'Invalid email or Password'
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::guard('restaurant')->Logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('owner.login');
    }
    
    public function changePassword(){
        return view('restaurant-owners.setting.index');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $authUser = Auth::guard('restaurant')->user();

        if (!$authUser) {
            return back()->withErrors(['current_password' => 'User not found']);
        }

        // Ensure we have an Eloquent Restaurant model instance so ->save() exists
        $restaurant = $authUser instanceof \App\Models\Restaurant
            ? $authUser
            : Restaurant::find($authUser->getAuthIdentifier());

        if (!$restaurant) {
            return back()->withErrors(['current_password' => 'User not found']);
        }

        if (!Hash::check($request->current_password, $restaurant->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $restaurant->password = Hash::make($request->new_password);
        $restaurant->save();

        return back()->with('success', 'Password updated successfully');
    }
}
