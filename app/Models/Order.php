<?php

namespace App\Models;

use App\Models\ProductList\OrderProduct;
use App\Models\ProductList\UserProductList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Order\OrderStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends UserProductList
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $pivotClass = OrderProduct::class;

    protected $casts = [
        'status' => OrderStatus::class,
    ];

    protected $fillable = [
        'user_id',
        'address_id',
        'email',
        'total_price',
        'status'
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function getTotalPrice(): float
    {
        return $this->total_price;
    }
}
