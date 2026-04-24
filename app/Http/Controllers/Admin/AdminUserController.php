<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', false)
            ->latest()
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with(['reservations', 'reviews', 'coupons', 'stamps'])
            ->withCount('stamps')
            ->findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'status' => 'required|in:active,suspended,banned',
        ]);

        $user->status = $request->status;
        $user->save();

        return back()->with('success', 'User status updated.');
    }
}