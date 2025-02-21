<?php

namespace App\Models;

use App\Models\ProductList\UserProductList;
use App\Models\ProductList\WishlistProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Wishlist extends UserProductList
{
    /** @use HasFactory<\Database\Factories\WishlistFactory> */
    use HasFactory;
    protected $pivotClass = WishlistProduct::class;

    public function products(): BelongsToMany
    {
        // laravel assumes table names are in alphabetical_order, this one isn't
        return $this->belongsToMany(Product::class, 'wishlist_product')
            ->using($this->pivotClass)
            ->withTimestamps();
    }
}
