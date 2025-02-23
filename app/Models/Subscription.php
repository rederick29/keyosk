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

    // TODO: create an event dispatcher for the subscription model to send mails / stat tracking
    // TODO: payments should be associated with the subscription

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTierGradient(): string
    {
        return $this->tier->getGradient();
    }

    public function renew(int $days): self
    {
        $this->ends_at = $this->ends_at && $this->ends_at->isFuture()
            ? $this->ends_at->addDays($days)
            : now()->addDays($days);
        $this->save();

        return $this;
    }

    // If the subscription has started and has no end date / end date is in the future
    public function isActive(): bool
    {
        return $this->started_at->isPast() &&
               ($this->ends_at === null || $this->ends_at->isFuture());
    }

    public function isExpired(): bool
    {
        return !$this->isActive();
    }

    public function daysUntilExpiry(): ?int
    {
        return $this->ends_at ? now()->diffInDays($this->ends_at) : null;
    }
}
