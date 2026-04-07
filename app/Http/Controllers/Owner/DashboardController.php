<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Reservation;
use App\Http\Controllers\Owner\OrdersController;

class DashboardController extends Controller
{
    public function index(){

        $owner = Auth::guard('restaurant')->user();

        $todayReservations = Reservation::Where('restaurant_id',$owner->id)
        ->whereDate('reservation_date', Carbon::today())
        ->orderBy('reservation_time','asc')
        ->limit(5)
        ->get();

        $reservationCount = $todayReservations->count();

        $pendingOrder = Order::where('restaurant_id',$owner->id)->where('status','pending')->get();


        return view('restaurant-owners.dashboard',compact('todayReservations','reservationCount','pendingOrder'));
    }
}
