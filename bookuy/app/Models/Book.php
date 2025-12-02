<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'books';
    
    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'category',
        'mata_kuliah',
        'location',
        'author',
        'stock',
        'type'
    ];

    /**
     * Get all cart items for this book.
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'book_id');
    }

    /**
     * Get all order items for this book.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'book_id');
    }
}
