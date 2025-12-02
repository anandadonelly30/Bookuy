<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function viewUserNotifications()
    {
        $notificationsCollection = Notification::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        $notifications = $notificationsCollection->groupBy(function ($notification) {
            if ($notification->created_at->isToday()) {
                return 'Today';
            }
            if ($notification->created_at->isYesterday()) {
                return 'Yesterday';
            }
            return $notification->created_at->format('F j, Y');
        });

        return view('notifications.index', compact('notifications'));
    }

    public function markNotificationAsRead(Notification $notification)
    {
        if ($notification->user_id === Auth::id()) {
            $notification->update(['is_read' => true]);
        }
        return redirect()->back();
    }
}