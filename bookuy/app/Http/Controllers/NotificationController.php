<?php


// FILE: app/Http/Controllers/NotificationController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // == USE CASE: ViewNotif ==
    public function index()
    {
        // Dummy notifications data sesuai screenshot
        $notificationsData = collect([
            // Today
            (object)[
                'id' => 1,
                'title' => '50% Special Discount!',
                'message' => 'Special promotion only today',
                'type' => 'discount',
                'read_at' => null,
                'created_at' => now(),
            ],
            
            // Yesterday
            (object)[
                'id' => 2,
                'title' => 'Top Up E-wallet Successfully!',
                'message' => 'You have top up e-wallet',
                'type' => 'wallet',
                'read_at' => null,
                'created_at' => now()->subDay(),
            ],
            (object)[
                'id' => 3,
                'title' => 'New Service Available!',
                'message' => 'Now you can track order in real-time',
                'type' => 'service',
                'read_at' => null,
                'created_at' => now()->subDay(),
            ],
            
            // May 7, 2025
            (object)[
                'id' => 4,
                'title' => 'Credit Card Connected!',
                'message' => 'Credit card has been linked',
                'type' => 'card',
                'read_at' => true,
                'created_at' => now()->setDate(2025, 5, 7),
            ],
            (object)[
                'id' => 5,
                'title' => 'Account Setup Successfully!',
                'message' => 'Your account has been created',
                'type' => 'success',
                'read_at' => true,
                'created_at' => now()->setDate(2025, 5, 7),
            ],
        ]);
        
        $notifications = $notificationsData->groupBy(function($notification) {
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