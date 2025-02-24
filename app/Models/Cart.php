<?php

namespace App\Models;

use App\Models\ProductList\CartProduct;
use App\Models\ProductList\UserProductList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Cart extends UserProductList
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;
    protected $pivotClass = CartProduct::class;

    /**
     * Adds a product to the cart.
     *
     * @param int $productId The ID of the product to add.
     * @param int $quantity The quantity of the product to add.
     * @return void
     */
    public function addProduct(int $productId, int $quantity = 1): void
    {
        $product = Product::find($productId);
        if (!$product) {
            throw new ModelNotFoundException('Product id not found');
        }

        if ($quantity > $product->stock || $this->getProductQuantity($productId) + $quantity > $product->stock) {
            throw new \InvalidArgumentException("Not enough stock for this product");
        }
        parent::addProduct($productId, $quantity);
    }

    /**
     * Decrements the quantity of a specified product in the cart.
     *
     * @param int $productId The ID of the product to decrement.
     * @param int $quantity The amount to decrement the product quantity by. Defaults to 1.
     * @return string A message indicating the result of the operation.
     */
    public function removeProduct(int $productId, int $quantity = 1): string
    {
        return parent::removeProduct($productId, $quantity) . " from cart.";
    }
}
