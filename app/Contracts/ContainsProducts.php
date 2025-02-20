<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// there is a pivot table for ThisProduct where This is a Model
trait ContainsProducts
{
    public abstract function products(): BelongsToMany;

    public function getProductQuantity(int $productId): int
    {
        $product = $this->products->find($productId);
        return $product->pivot->quantity ?? 0;
    }

    public function hasProducts(): bool
    {
        return !$this->products->isEmpty();
    }

    public function getTotalPrice(): float
    {
        $this->load('products');

        $totalPrice = 0.0;
        foreach ($this->products as $product) {
            $quantity = $this->products()->select(['quantity'])->where('product_id', $product->id)->first()->quantity;
            $totalPrice += $product->price * $quantity;
        }
        return $totalPrice;
    }
}
