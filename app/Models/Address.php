<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    /** @use HasFactory<\Database\Factories\AddressFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'line_one',
        'line_two',
        'city',
        'postcode',
        'country_id',
        'priority',
        'user_id'
    ];

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

    static function getMaxPriority(User $user)
    {
        $max_priority = $user->addresses()->whereNotNull('priority')->max('priority');
        if ($max_priority == 0 && !$user->addresses()->whereNotNull('priority')->exists()) {
            $max_priority = -1;
        }
        return $max_priority;
    }
}
