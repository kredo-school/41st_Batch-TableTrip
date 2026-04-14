<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class AdminRestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::latest()->paginate(10);

        return view('admin.restaurants.index', compact('restaurants'));
    }

    public function show($id)
    {
        $restaurant = Restaurant::with('category')->findOrFail($id);

        return view('admin.restaurants.show', compact('restaurant'));
    }

    public function approve($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->approval_status = 'approved';
        $restaurant->save();

        return redirect()
            ->route('admin.restaurants.index')
            ->with('success', 'Restaurant approved successfully.');
    }

    public function reject($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->approval_status = 'rejected';
        $restaurant->save();

        return redirect()
            ->route('admin.restaurants.index')
            ->with('success', 'Restaurant rejected successfully.');
    }
}