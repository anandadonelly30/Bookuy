<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'type'  // Now stores 'BUY' or 'RENT' (uppercase) to match class diagram
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    
    // Alias for class diagram compatibility (bookId instead of product_id)
    public function getBookIdAttribute()
    {
        return $this->product_id;
    }
    
    public function setBookIdAttribute($value)
    {
        $this->attributes['product_id'] = $value;
    }

    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->product->price;
    }
}