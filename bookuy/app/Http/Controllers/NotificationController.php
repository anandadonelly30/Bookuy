<?php


// FILE: app/Http/Controllers/NotificationController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * View list of user notifications grouped by date.
     * 
     * USE CASE: ViewNotif
     * Retrieves all notifications for the authenticated user,
     * groups them by date (Today, Yesterday, or specific date),
     * and displays them in chronological order.
     */
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

    /**
     * Mark a specific notification as read.
     * 
     * Updates the is_read status of a notification to true.
     * Validates that the notification belongs to the authenticated user.
     */
    public function markNotificationAsRead(Notification $notification)
    {
        // Validate ownership and mark as read
        if ($notification->user_id === Auth::id()) {
            $notification->update(['is_read' => true]); // Updated to use is_read (class diagram)
        }
        return redirect()->back();
    }
}