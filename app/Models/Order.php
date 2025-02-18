<?php

namespace App\Models;

use App\Contracts\ContainsProducts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order\OrderStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use ContainsProducts;

    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $casts = [
        'status' => OrderStatus::class,
    ];

    protected $fillable = [
        'user_id',
        'address_id',
        'total_price',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->using(OrderProduct::class)
            ->withPivot(['quantity', 'price'])
            ->withTimestamps();
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function getTotalPrice(): float
    {
        return $this->total_price;
    }
}
