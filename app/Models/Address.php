<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    /** @use HasFactory<\Database\Factories\AddressFactory> */
    use HasFactory;

    function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
