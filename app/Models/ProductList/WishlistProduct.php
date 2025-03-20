<?php

namespace App\Models\ProductList;

use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WishlistProduct extends ProductPivot
{
    protected $table = 'wishlist_product';
    protected $fillable = ['wishlist_id', 'product_id'];

    public function wishlist(): BelongsTo
    {
        return $this->belongsTo(Wishlist::class);
    }
}
