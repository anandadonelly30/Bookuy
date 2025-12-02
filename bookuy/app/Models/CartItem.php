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
        'type'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
    
    public function book(): BelongsTo
    {
        return $this->product();
    }
    
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