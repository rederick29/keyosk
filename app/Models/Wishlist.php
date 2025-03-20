<?php

namespace App\Models;

use App\Models\ProductList\BaseProductList;
use App\Models\ProductList\WishlistProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Wishlist extends BaseProductList
{
    /** @use HasFactory<\Database\Factories\WishlistFactory> */
    use HasFactory;
    protected $pivotClass = WishlistProduct::class;

    protected $fillable = ['user_id'];
    public function products(): BelongsToMany
    {
        // laravel assumes table names are in alphabetical_order, this one isn't
        return $this->belongsToMany(Product::class, 'wishlist_product')
            ->using($this->pivotClass)
            ->withTimestamps();
    }
}
