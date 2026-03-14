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
    
}
