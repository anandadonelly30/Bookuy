<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 
        'address_id', 
        'sub_total',
        'shipping_fee',
        'admin_fee',
        'total',
        'total_amount',
        'status',
        'payment_status',
        'payment_method'
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
    
    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->total_amount ?? $value,
        );
    }
}
