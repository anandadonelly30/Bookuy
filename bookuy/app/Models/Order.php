<?php


// FILE: app/Models/Order.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    use HasFactory;
    
    // Updated to match class diagram
    protected $fillable = [
        'user_id', 
        'address_id', 
        'sub_total',      // Enhancement: detailed breakdown
        'shipping_fee',   // Enhancement: detailed breakdown
        'admin_fee',      // Enhancement: detailed breakdown
        'total',          // Keep for backward compatibility
        'total_amount',   // New: matches class diagram
        'status',         // Now uses ONGOING/COMPLETED
        'payment_status', // New: matches class diagram
        'payment_method'  // Keep for reference
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    
    // Backward compatibility: total returns total_amount if available
    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->total_amount ?? $value,
        );
    }
}
