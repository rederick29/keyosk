<?php

namespace App\Models\ProductList;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use RangeException;

abstract class UserProductListWithQuantity extends UserProductList
{
    public function products(): BelongsToMany {
        return parent::products()->withPivot('quantity');
    }
    public function addProduct(int $productId, int $quantity = 1): void {
        // Find the product or throw an exception
        $product = Product::find($productId);
        if (!$product) {
            throw new ModelNotFoundException('Product id not found');
        }

        if ($quantity < 1) {
            throw new RangeException("Quantity must be at least 1");
        }

        // Check if the product already exists in the list
        $currentQuantity = $this->getProductQuantity($productId);

        // Update quantity if the product exists, or attach it if new
        if ($currentQuantity > 0) {
            $this->products()->updateExistingPivot($productId, ['quantity' => $currentQuantity + $quantity]);
        } else {
            $this->products()->attach($productId, ['quantity' => $quantity]);
        }
    }

    public function removeProduct(int $productId, int $quantity = 1): bool|string {
        // Find the product or throw an exception
        $currentQuantity = $this->getProductQuantity($productId);
        if ($currentQuantity === 0) {
            throw new ModelNotFoundException("Product not found");
        }

        // Update quantity if the product exists, or delete it if quantity is 0
        $newQuantity = $currentQuantity - $quantity;
        if ($newQuantity <= 0) {
            $this->emptyItem($productId);
            return 'Product removed';
        } else {
            $this->products()->updateExistingPivot($productId, ['quantity' => $newQuantity]);
            return "$quantity products removed";
        }
    }

    public function getProductQuantity(int $productId): int
    {
        $product = $this->products->find($productId);
        return $product->pivot->quantity ?? 0;
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

    // Removes all instances of a product from the cart
    public function emptyItem(int $productId): void
    {
        parent::removeProduct($productId);
    }
}
