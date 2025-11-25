<?php


// FILE: app/Http/Controllers/NotificationController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    // == USE CASE: ViewNotif ==
    public function index()
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

    public function markAsRead(Notification $notification)
    {
        // Optional: jika mau mark per-klik
        if ($notification->user_id === Auth::id()) {
            $notification->update(['read_at' => now()]);
        }
        return redirect()->back();
    }
}