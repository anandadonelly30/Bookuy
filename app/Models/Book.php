<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author',
        'description',
        'price',
        'stock',
        'published_date',
        'user_id',
        'seller_id',
        'price_buy',
        'price_rent',
        'cover',
        'cover_image_url',
        'short_description',
        'full_description',
        'address',
        'condition',
        'category',
        'pages',
        'rating_average',
        'rating_count',
        'is_recommended',
        'popularity_score',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_recommended' => 'boolean',
        'popularity_score' => 'integer',
        'price_buy' => 'integer',
        'price_rent' => 'integer',
        'pages' => 'integer',
        'rating_average' => 'float',
        'rating_count' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookCategory(): BelongsTo
    {
        return $this->belongsTo(BookCategory::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'book_category');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
