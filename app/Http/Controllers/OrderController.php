<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * ViewOrderHistory
     * Message 1.1: getHistory(userID)
     *
     */
    public function getHistory(Request $request)
    {
        $userId = Auth::id();
        $currentTab = $request->query('tab', 'ongoing');

        // Memanggil Model sesuai Sequence Diagram
        // Message 1.1.1: findByBuyer(userID)
        $allOrders = Order::findByBuyer($userId);

        // Logika Filter Tab
        if ($currentTab == 'completed') {
            $orders = $allOrders->whereIn('status', ['Completed', 'Delivered']);
        } else {
            $orders = $allOrders->whereIn('status', ['Packing', 'Picked', 'In Transit', 'Delivered', 'Completed']);
        }

        // Message 1.1.2: renderPage / displayRiwayat
        return view('history.purchase', compact('orders', 'currentTab'));
    }

    /**
     * ViewSalesHistory
     * Message 1.1: getHistory(userID)
     */
    public function getSalesHistory(Request $request)
    {
        $userId = Auth::id();
        $currentTab = $request->query('tab', 'ongoing');

        // Query : Cari order item dimana bukunya adalah milik user ini
        $query = Order::whereHas('items.book', function($q) use ($userId) {
            $q->where('user_id', $userId);
        })->with(['items.book', 'items.book.reviews']);

        // Filter Tab
        if ($currentTab == 'completed') {
            $query->whereIn('status', ['Completed', 'Delivered']);
        } else {
            $query->whereIn('status', ['Packing', 'Picked', 'In Transit']);
        }

        $orders = $query->latest()->get();

        return view('history.sales', compact('orders', 'currentTab'));
    }

    /**
     * ViewOrderStatus
     * Message 2.1: getOrderStatus(orderID)
     */
    public function getOrderStatus($id)
    {
        $order = Order::where('id', $id)->firstOrFail();

        // Jika saya adalah PEMBELI order ini -> Balik ke Purchase History
        // Jika bukan (berarti saya PENJUAL) -> Balik ke Sales History
        $backUrl = ($order->user_id == \Illuminate\Support\Facades\Auth::id())
            ? route('purchase.history')
            : route('sales.history');


        // Status dianggap 'completed' jika status order saat ini berada di tahap itu atau melewatinya.
        $status = $order->status;

        // Helper untuk cek status
        $isPassed = function($target) use ($status) {
            $levels = ['Packing' => 1, 'Picked' => 2, 'In Transit' => 3, 'Delivered' => 4, 'Completed' => 5];

            // Normalisasi status database ke level
            $currentLevel = $levels[$status] ?? 0;
            if ($status == 'Delivered' || $status == 'Completed') $currentLevel = 5;

            return $currentLevel >= $levels[$target];
        };

        $trackingSteps = [
            [
                'status' => 'Packing',
                'location' => 'BME Barat',
                'completed' => $isPassed('Packing'),
            ],
            [
                'status' => 'Picked',
                'location' => 'BME Barat',
                'completed' => $isPassed('Picked'),
            ],
            [
                'status' => 'In Transit',
                'location' => 'Jalan Teknik Perkapalan',
                'completed' => $isPassed('In Transit'),
            ],
            [
                'status' => 'Delivered',
                'location' => 'Jalan Teknik Komputer Blok U 38',
                'completed' => $isPassed('Delivered'),
            ]
        ];

        return view('history.track', compact('order', 'trackingSteps', 'backUrl'));
    }
}
