<?php

namespace App\Models;

use App\Models\Subscription\SubscriptionTiers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = ['tier', 'user_id', 'started_at', 'ends_at'];

    protected $casts = [
        'tier' => SubscriptionTiers::class,
        'started_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTierGradient(): string
    {
        return $this->tier->getGradient();
    }
}
