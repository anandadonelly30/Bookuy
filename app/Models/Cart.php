<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Get or create a cart for the current session/user.
     */
    public static function getOrCreateCart(): self
    {
        $sessionId = session()->getId();

        $cart = self::where('session_id', $sessionId)->first();

        if (!$cart) {
            $cart = self::create([
                'session_id' => $sessionId,
                'user_id' => null,
            ]);
        }

        return $cart;
    }

    /**
     * Calculate the total for buy items.
     */
    public function getBuySubtotalAttribute(): int
    {
        return $this->items()
            ->where('type', 'buy')
            ->get()
            ->sum(fn($item) => $item->price * $item->quantity);
    }

    /**
     * Calculate the total for rent items.
     */
    public function getRentSubtotalAttribute(): int
    {
        return $this->items()
            ->where('type', 'rent')
            ->get()
            ->sum(fn($item) => $item->price * $item->quantity);
    }

    /**
     * Get the grand total.
     */
    public function getTotalAttribute(): int
    {
        return $this->buy_subtotal + $this->rent_subtotal;
    }
}
