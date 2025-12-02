<?php


// FILE: app/Models/Notification.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Notification extends Model
{
    use HasFactory;
    
    // Updated to match class diagram
    protected $fillable = ['user_id', 'title', 'description', 'icon', 'is_read'];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    // Backward compatibility accessors for views still using old field names
    protected function message(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->description,
            set: fn ($value) => ['description' => $value],
        );
    }
    
    protected function readAt(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->is_read ? now() : null,
            set: fn ($value) => ['is_read' => $value !== null],
        );
    }
}