<?php

namespace App\Models\ProductList;

use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderProduct extends ProductPivot
{
    protected $table = 'order_product';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];
    public const extra_columns = ['price'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
