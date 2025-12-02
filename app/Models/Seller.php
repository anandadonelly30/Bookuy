<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'avatar',
        'about',
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
