<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    public function index(){
        $owner = Auth::guard('restaurant')->user();

        $reservations = Reservation::where('restaurant_id',$owner->id)
        ->latest()
        ->paginate(5);

        return view('restaurant-owners.reservations.index',compact('owner','reservations'));
    }

    public function store(Request $request){
        
        $request->validate([
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'number_of_people' => 'required|integer|min:1',
            'full_name' => 'required|string|max:225',
            'phone' => 'required|string|max:225',
            'email' => 'nullable|email|max:225',
            'special_requests' => 'nullable|string|max:100',
            'status' => 'required|in:confirmed,pending,completed,cancelled,no-show'
        ]);

        $reservation = new Reservation();
        $reservation -> restaurant_id = Auth::id();
        $reservation -> user_id = null;
        $reservation -> reservation_date = $request -> reservation_date;
        $reservation -> reservation_time = $request -> reservation_time;
        $reservation -> number_of_people = $request -> number_of_people;
        $reservation -> full_name = $request -> full_name;
        $reservation -> phone = $request -> phone;
        $reservation -> email = $request -> email;
        $reservation -> special_requests = $request -> special_request;
        $reservation -> status = $request->status;
        $reservation -> save();

        return redirect()->back()->with('success', 'Reservation added successfully.');
    }
    
}
