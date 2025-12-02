<?php
// FILE: app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Updated to match class diagram
    protected $fillable = [
        'username',        // Renamed from 'name'
        'email',
        'password',
        'gender',          // Enhancement (not in diagram)
        'semester',        // Enhancement (not in diagram)
        'description',     // Enhancement (not in diagram)
        'no_telp',         // Renamed from 'phone_number'
        'profile_picture', // Enhancement (not in diagram)
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function defaultAddress()
    {
        return $this->hasOne(Address::class)->where('is_default', true);
    }
    
    // Backward compatibility accessors for views using old field names
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->username,
            set: fn ($value) => ['username' => $value],
        );
    }
    
    protected function phoneNumber(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->no_telp,
            set: fn ($value) => ['no_telp' => $value],
        );
    }
}