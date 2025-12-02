<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class OrderItem extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_id', 
        'book_id',
        'quantity', 
        'price_per_unit',
        'product_name'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
    
    public function book(): BelongsTo
    {
        return $this->product();
    }
    
    protected function productId(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->book_id,
            set: fn ($value) => ['book_id' => $value],
        );
    }
    
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->price_per_unit,
            set: fn ($value) => ['price_per_unit' => $value],
        );
    }
}