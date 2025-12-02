<?php


// FILE: app/Models/OrderItem.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class OrderItem extends Model
{
    use HasFactory;
    
    // Updated to match class diagram
    protected $fillable = [
        'order_id', 
        'book_id',        // Renamed from 'product_id'
        'quantity', 
        'price_per_unit', // Renamed from 'price'
        'product_name'    // Enhancement: keeps product info
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'book_id');
    }
    
    // Backward compatibility accessors
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