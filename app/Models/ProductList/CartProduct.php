<?php

namespace App\Models\ProductList;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartProduct extends ProductPivot
{
    protected $table = 'cart_product';
    protected $fillable = ['cart_id', 'product_id', 'quantity'];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
}
