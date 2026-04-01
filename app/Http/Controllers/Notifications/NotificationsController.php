<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;


class NotificationsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = Notification::where('recipient_id', $user->id)
            ->where('recipient_type', get_class($user))
            ->latest()
            ->paginate(10);

        return view('user.notification.index', compact('notifications'));
    }
}
