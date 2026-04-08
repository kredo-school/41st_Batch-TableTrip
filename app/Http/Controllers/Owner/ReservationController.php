<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{

   public function index(Request $request)
    {
    $owner = Auth::guard('restaurant')->user();

    $query = Reservation::where('restaurant_id', $owner->id);

    // search name
    if ($request->filled('nameSearch')) {
    $keyword = trim($request->nameSearch);
    $query->where('full_name', 'like', '%' . $keyword . '%');
    }

    // search status
    if ($request->filled('status')) {
    $query->where('status', $request->status);
    }

    // search date
    if ($request->filled('date')) {
    $query->whereDate('reservation_date', $request->date);

    } elseif (!$request->filled('nameSearch') && !$request->filled('status')) {
    // 何も検索してない時だけ
    $query->whereDate('reservation_date', '>=', Carbon::today());
    }

    $reservations = $query
    ->orderBy('reservation_date', 'asc')
    ->orderBy('reservation_time', 'asc')
    ->paginate(10)
    ->withQueryString();

    // calendar
    $currentMonth = $request->filled('month')
     ? Carbon::createFromFormat('Y-m',$request->month)->startOfMonth()
     : Carbon::now()->startOfMonth();

    $startOfMonth = $currentMonth->copy()->startOfMonth();
    $endOfMonth = $currentMonth;

    $monthlyReservations = Reservation::where('restaurant_id', $owner->id)
    ->whereYear('reservation_date', $currentMonth->year)
    ->whereMonth('reservation_date', $currentMonth->month)
    ->get();

        $reservationCounts = $monthlyReservations
         ->groupBy(function($reservation){
            return Carbon::parse($reservation->reservation_date)->format('Y-m-d');
         })
         ->map(function($items){
            return $items->count();
         })
         ->toArray();

        
       return view('restaurant-owners.reservations.index', compact('owner', 'reservations','currentMonth','reservationCounts'));
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
        $reservation -> special_requests = $request -> special_requests;
        $reservation -> status = $request->status;
        $reservation -> save();

        return redirect()->back()->with('success', 'Reservation added successfully.');
    }

    public function update(Request $request , $id){

       $validator = Validator::make($request->all(), [
        'reservation_date' => 'required|date',
        'reservation_time' => 'required',
        'number_of_people' => 'required|integer|min:1',
        'full_name' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'special_requests' => 'nullable|string|max:100',
        'status' => 'required|in:confirmed,pending,completed,cancelled,no-show',
    ]);

    if ($validator->fails()) {
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput()
            ->with('open_edit_modal', $id);
    }


        $reservation = Reservation::findOrFail($id);

        if(Auth::guard('restaurant')->id() !== $reservation->restaurant_id){
            return redirect()->route('owner.reservations');
        }

        $reservation -> reservation_date = $request -> reservation_date;
        $reservation -> reservation_time = $request -> reservation_time;
        $reservation -> number_of_people = $request -> number_of_people;
        $reservation -> full_name = $request -> full_name;
        $reservation -> phone = $request -> phone;
        $reservation -> email = $request -> email;
        $reservation -> special_requests = $request -> special_requests;
        $reservation -> status = $request->status;
        $reservation -> save();

        return redirect()->back();
    }

    public function show($id){

        $reservation = Reservation::findOrFail($id);

        return view('restaurant-owners.reservations.reservation-details',compact('reservation'));
    }
    
}
