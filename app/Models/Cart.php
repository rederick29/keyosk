<?php

namespace App\Models;

use App\Contracts\ContainsProducts;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    use ContainsProducts;

    /**
     * Adds a product to the cart.
     *
     * @param int $productId The ID of the product to add.
     * @param int $quantity The quantity of the product to add.
     * @return void
     */
    public function addProduct(int $productId, int $quantity): void
    {
        // Find the product or throw an exception
        $product = Product::find($productId);
        if (!$product) {
            throw new \Exception("Product not found");
        }

        if ($quantity < 1) {
            throw new \Exception("Quantity must be at least 1");
        }

        // Check if stock is sufficient
        if ($quantity > $product->stock) {
            throw new \Exception("Not enough stock for this product");
        }

        // Check if the product already exists in the cart
        $currentQuantity = $this->getProductQuantity($productId);

        // Update quantity if the product exists, or attach it if new
        if ($currentQuantity > 0) {
            $newQuantity = $currentQuantity + $quantity;

            if ($newQuantity > $product->stock) {
                throw new \Exception("Quantity exceeds available stock");
            }

            $this->products()->updateExistingPivot($productId, ['quantity' => $newQuantity]);
        } else {
            $this->products()->attach($productId, ['quantity' => $quantity]);
        }
    }

    /**
     * Decrements the quantity of a specified product in the cart.
     *
     * @param int $productId The ID of the product to decrement.
     * @param int $quantity The amount to decrement the product quantity by. Defaults to 1.
     * @return string A message indicating the result of the operation.
     */
    public function removeProduct(int $productId, int $quantity = 1): String
    {
        // Find the product or throw an exception
        $currentQuantity = $this->getProductQuantity($productId);
        if ($currentQuantity === 0) {
            throw new \Exception("Product not found in cart");
        }

        // Update quantity if the product exists, or delete it if quantity is 0
        $newQuantity = $currentQuantity - $quantity;
        if ($newQuantity <= 0) {
            $this->emptyItem($productId);
            return 'Product removed from cart';
        } else {
            $this->products()->updateExistingPivot($productId, ['quantity' => $newQuantity]);
            return "$quantity products removed from cart";
        }
    }

    // Removes all instances of a product from the cart
    public function emptyItem(int $productId): void
    {
        $this->products()->detach($productId);
    }

    // Removes all products from the cart
    public function emptyCart(): void
    {
        $this->products()->detach();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->using(CartProduct::class)
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
