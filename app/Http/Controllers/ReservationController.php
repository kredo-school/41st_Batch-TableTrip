<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationController extends Controller
{
    
public function index()
{
    $user = Auth::user();

    // upcoming reservation
    $upcoming_reservations = $user->reservations()
        ->where('reservation_date', '>=', now()->toDateString())
        ->where('status', '!=', 'visited') 
                ->orderBy('reservation_date', 'asc')
        ->get();

    // past reservation
    $past_visits = $user->reservations()
        ->where(function($query) {
            $query->where('reservation_date', '<', now()->toDateString())
                  ->orWhere('status', 'visited');
        })
        ->orderBy('reservation_date', 'desc')
        ->get();
        
    return view('user.reservations.index', compact('upcoming_reservations', 'past_visits'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required',
            'number_of_people' => 'required|integer|min:1',
        ]);

        Reservation::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $validated['restaurant_id'],
            'reservation_date' => $validated['reservation_date'],
            'reservation_time' => $validated['reservation_time'],
            'number_of_people' => $validated['number_of_people'],
            'status' => 'pending', 
        ]);

        return redirect()->route('dashboard')->with('success', 'Reservation completed!');
    }


    public function destroy($id)
    {
        $reservation = Reservation::where('user_id', Auth::id())->findOrFail($id);
        $reservation->delete();

        return redirect()->back()->with('success', 'Reservation cancelled.');
    }

}