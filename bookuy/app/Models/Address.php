<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Address extends Model
{
    use HasFactory;
    
    // Updated to match class diagram
    protected $fillable = [
        'user_id',
        'label_address',      // Renamed from 'nickname'
        'receiver_name',      // NEW - CRITICAL field from diagram
        'department',         // Enhancement (not in diagram)
        'street',             // NEW - split from full_address
        'city',               // NEW - split from full_address
        'province',           // NEW - split from full_address
        'postal_code',        // NEW - split from full_address
        'full_address',       // Kept for backward compatibility
        'phone_number',
        'latitude',           // Enhancement for maps
        'longitude',          // Enhancement for maps
        'is_default'          // Enhancement for UX
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    // Backward compatibility accessor for views using 'nickname'
    protected function nickname(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->label_address,
            set: fn ($value) => ['label_address' => $value],
        );
    }
    
    // Auto-populate full_address from individual fields
    protected function fullAddress(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?? $this->constructFullAddress(),
        );
    }
    
    private function constructFullAddress(): string
    {
        $parts = array_filter([
            $this->street,
            $this->city,
            $this->province,
            $this->postal_code
        ]);
        
        return !empty($parts) ? implode(', ', $parts) : '';
    }
}