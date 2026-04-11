<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Notification;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index(){

        $owner = Auth::guard('restaurant')->user();

        //Reservations for today
        $todayReservations = Reservation::Where('restaurant_id',$owner->id)
        ->whereDate('reservation_date', Carbon::today())
        ->orderBy('reservation_time','asc')
        ->limit(5)
        ->get();

        $reservationCount = $todayReservations->count();

        //Pwning reservations
        $pendingReservations = Reservation::where('restaurant_id', $owner->id)
            ->where('status', 'pending')
            ->count();

        //Pending Orders
        $pendingOrders = Order::where('restaurant_id', $owner->id)
            ->where('status', 'pending')
            ->count();

        // Recent orders
        $orders = Order::where('restaurant_id', $owner->id)
            ->OrderBy('created_at', 'desc')
            ->limit(5)  
            ->get();

        // Unread notifications
        $notificationCount = Notification::where('recipient_id', $owner->id)
            ->where('recipient_type', Restaurant::class)
            ->where('is_completed', false)
            ->count();

        //Revenue for the last 7 days
       $sales = Order::where('restaurant_id', $owner->id)
        ->whereDate('created_at', '>=', Carbon::today()->subDays(6))
        ->selectRaw('DATE(created_at) as date, SUM(total_price) as total')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->format('Y-m-d');
            $labels[] = Carbon::parse($date)->format('M d');

            $daySale = $sales->firstWhere('date', $date);
            $data[] = $daySale ? (float) $daySale->total : 0;
        }

        //Top selling products for the last 7 days
       $topProducts = DB::table('purchased')
            ->join('products', 'purchased.meal_kit_id', '=', 'products.id')
            ->where('products.restaurant_id', $owner->id)
            ->select(
                'products.id',
                'products.name',
                'products.image',
                DB::raw('SUM(purchased.quantity) as total_quantity')
            )
            ->groupBy('products.id', 'products.name', 'products.image')
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get();

        $productLabels = $topProducts->pluck('name');
        $productData = $topProducts->pluck('total_quantity');

        $topProduct = $topProducts->first();
        $topProductCount = $topProduct ? $topProduct->total_quantity : 0;

        return view('restaurant-owners.dashboard',compact('todayReservations','reservationCount','pendingOrders','pendingReservations','orders','notificationCount','labels','data','productLabels','productData','topProduct','topProductCount') );
    }
}
