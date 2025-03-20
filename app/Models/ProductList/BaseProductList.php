<?php

namespace App\Models\ProductList;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

abstract class BaseProductList extends Model
{
    protected $pivotClass;

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->using($this->pivotClass)
            ->withPivot($this->pivotClass::extra_columns)
            ->withTimestamps();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function hasProducts(): bool
    {
        return !$this->products->isEmpty();
    }

    // Removes all products from the cart
    public function emptyList(): void
    {
        $this->products()->detach();
    }

    public function addProduct(int $productId): void
    {
        if (!Product::find($productId)) {
            throw new ModelNotFoundException('Product id not found');
        }
        $this->products()->attach($productId);
    }

    public function removeProduct(int $productId): bool|string
    {
        if (!Product::find($productId)) {
            throw new ModelNotFoundException('Product id not found');
        }
        $this->products()->detach($productId);
        return true;
    }

    public function getTotalPrice(): float
    {
        $this->load('products');

        $totalPrice = 0.0;
        foreach ($this->products as $product) {
            $totalPrice += $product->price;
        }
        return $totalPrice;
    }
}
