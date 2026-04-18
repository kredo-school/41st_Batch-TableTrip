<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Notification; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class NotificationsController extends Controller
{
    public function index()
{
    $user = Auth::user();

    $notifications = Notification::where('recipient_id', $user->id)
        ->where('recipient_type', get_class($user))
        ->orderBy('created_at', 'desc')
        ->paginate(15);

    return view('user.notifications.index', compact('notifications'));
}

   public function show($id)
{
    $notification = Notification::findOrFail($id);

    if ($notification->recipient_id !== Auth::id()) {
        abort(403);
    }

    $notification->update(['is_completed' => true]);

    return view('user.notifications.show', compact('notification'));
}

    public function complete($id)
    {
        $notification = Notification::findOrFail($id);

        if ($notification->recipient_id !== Auth::id()) {
            abort(403);
        }

        $notification->update([
            'is_completed' => true
        ]);

        return back()->with('success', 'Mark as done');
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);

        if ($notification->recipient_id !== Auth::id()) {
            abort(403);
        }

        $notification->delete();

        return back()->with('success', 'Deleted!');
    }
}