<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index(){
        $user=Auth::user();

        $reservations = Reservation::where('user_id', $user->id)
            ->with('restaurant')
            ->orderBy('reservation_date','asc')
            ->get();
        return view('user.reservations.index', compact('reservations'));
    }
}
