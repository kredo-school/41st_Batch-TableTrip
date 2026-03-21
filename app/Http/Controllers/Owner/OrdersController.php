<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class OrdersController extends Controller
{
    public function index(){

        return view('restaurant-owners.orders.index');
    }
}
