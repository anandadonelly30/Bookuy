<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function user() { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(OrderItem::class); }

    /**
     * Sesuai Sequence Diagram: ViewOrderHistory
     * Message 1.1.1: findByBuyer(userID)
     */
    public static function findByBuyer($userId)
    {
        return self::where('user_id', $userId)
                   ->with(['items.book', 'items.book.reviews'])
                   ->latest()
                   ->get();
    }

    /**
     * Sesuai Sequence Diagram: ViewSalesHistory
     * Message 1.1.1: findBySeller(userID)
     */
    public static function findBySeller($userId)
    {
        // Mencari order yang item-nya adalah buku milik seller (user)
        return OrderItem::whereHas('book', function($q) use ($userId) {
            $q->where('user_id', $userId);
        })->with(['book', 'order.user'])->latest()->get();
    }

    /**
     * Sesuai Sequence Diagram: TrackOrder
     * Message 2.1.1: findStatus(orderID)
     */
    public static function findStatus($orderId)
    {
        return self::where('id', $orderId)->firstOrFail();
    }
}
