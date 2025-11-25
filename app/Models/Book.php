<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'category',
        'condition',
        'sell_price',
        'rent_price',
        'image_url',
    ];

    public function sellerItems(): HasMany
    {
        return $this->hasMany(SellerItem::class);
    }
}