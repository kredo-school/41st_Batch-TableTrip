<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Restaurant;

class AdminReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::latest()->paginate(10);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function show($id)
    {
        $reservation = Reservation::with('user', 'restaurant')->findOrFail($id);

        return view('admin.reservations.show', compact('reservation'));
    }
}