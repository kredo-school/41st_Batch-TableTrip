<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Order;

class OrdersController extends Controller
{
    public function index(Request $request){

        $owner = Auth::guard('restaurant')->user();

        $query = Order::where('restaurant_id',$owner->id);

       if ($request->filled('search')) {
        $keyword = trim($request->search);

        $query->where(function ($q) use ($keyword) {
            $q->where('id', 'like', '%' . $keyword . '%')
              ->orWhereHas('user', function ($userQuery) use ($keyword) {
                  $userQuery->where('first_name', 'like', '%' . $keyword . '%')
                            ->orWhere('last_name', 'like', '%' . $keyword . '%')
                            ->orWhere('user_name', 'like', '%' . $keyword . '%');
              });
        });
       }

        if($request->filled('date')){
            $query->whereDate('created_at',$request->date);
        }

        if($request->filled('status')){
            $query->where('status',$request->status);
        }

        $orders = $query->with('purchasedItems.product')->paginate(10);

        return view('restaurant-owners.orders.index',compact('orders'));
    }

    public function show($id){

        $order = Order::with(['purchasedItems.product'])->findOrFail($id);

        return view('restaurant-owners.orders.order-details',compact('order'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'status' => 'required|in:pending,preparing,shipping,delivered,cancelled',
        ]);

        $order = Order::findOrFail($id);

         abort_if(Auth::guard('restaurant')->id() !== $order->restaurant_id, 403);

         $order->update([
            'status'=> $request->status,
         ]);

        return redirect()->back();
    }
}
