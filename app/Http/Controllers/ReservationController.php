<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Order; 
use Model\User;
use Carbon\Carbon;

class ReservationController extends Controller
{
        public function index()
    {
        $userId = Auth::id();
        $upcoming_reservations = Reservation::where('user_id', $userId)
            ->whereDate('reservation_date', '>=', now()->toDateString())
            ->with('restaurant')
            ->orderBy('reservation_date', 'asc')
            ->get();

        $past_reservations = Reservation::where('user_id', $userId)
            ->whereDate('reservation_date', '<', now()->toDateString())
            ->with('restaurant')
            ->orderBy('reservation_date', 'desc')
            ->get();

        $purchased = []; 

        return view('user.reservations.index', compact('upcoming_reservations', 'past_reservations', 'purchased'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required',
            'number_of_people' => 'required|integer|min:1',
            'full_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        Reservation::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $validated['restaurant_id'],
            'reservation_date' => $validated['reservation_date'],
            'reservation_time' => $validated['reservation_time'],
            'number_of_people' => $validated['number_of_people'],
            'full_name' => $validated['full_name'] ?? Auth::user()->name,
            'phone' => $validated['phone'] ?? Auth::user()->phone,
            'email' => $validated['email'] ?? Auth::user()->email,
            'status' => 'pending', 
        ]);

        return redirect()->route('user.reservations.index')->with('success', 'Reservation completed!');
    }

    public function destroy($id)
    {
        
        $reservation = Reservation::where('user_id', Auth::id())->findOrFail($id);
        
        $reservation->delete();

        return back()->with('success', 'Reservation cancelled.');
    }
}