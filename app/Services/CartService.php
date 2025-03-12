<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Utils\CartUpdateAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    private const SESSION_KEY = 'guest_cart';

    /**
     * Get the current cart (either authenticated user's cart or session cart)
     *
     * @return array|Cart Cart object or array representation for session carts
     */
    public function getCurrentCart()
    {
        if (Auth::check()) {
            return $this->getAuthUserCart();
        }

        return $this->getSessionCart();
    }

    /**
     * Get the authenticated user's cart
     *
     * @return Cart
     */
    public function getAuthUserCart(): Cart
    {
        $user = Auth::user();
        return $user->cart ?? Cart::factory()->forUser($user)->create();
    }

    /**
     * Get the session-based cart for guests
     *
     * @return array
     */
    public function getSessionCart(): array
    {
        if (!Session::has(self::SESSION_KEY)) {
            Session::put(self::SESSION_KEY, [
                'products' => [],
                'total_price' => 0
            ]);
        }

        return Session::get(self::SESSION_KEY);
    }

    /**
     * Check if the current cart has products
     *
     * @return bool
     */
    public function hasProducts(): bool
    {
        if (Auth::check()) {
            return Auth::user()->cart->hasProducts();
        }

        $sessionCart = $this->getSessionCart();
        return !empty($sessionCart['products']);
    }

    /**
     * Get the total price of the cart
     *
     * @return float
     */
    public function getTotalPrice(): float
    {
        if (Auth::check()) {
            return Auth::user()->cart->getTotalPrice();
        }

        $sessionCart = $this->getSessionCart();
        return $sessionCart['total_price'];
    }

    /**
     * Process cart actions for either authenticated or guest users
     *
     * @param CartUpdateAction $action
     * @param int $productId
     * @param int $quantity
     * @return string
     */
    public function processCartAction(CartUpdateAction $action, int $productId, int $quantity): string
    {
        if (Auth::check()) {
            $cart = $this->getAuthUserCart();

            switch ($action) {
                case CartUpdateAction::Add:
                case CartUpdateAction::Increase:
                    $cart->addProduct($productId, $quantity);
                    return 'Product added to cart';

                case CartUpdateAction::Remove:
                    $cart->emptyItem($productId);
                    return 'Product removed from cart';

                case CartUpdateAction::Decrease:
                    $cart->removeProduct($productId, $quantity);
                    return 'Product quantity decreased';

                default:
                    throw new \InvalidArgumentException('Invalid cart action');
            }
        } else {
            // Handle session cart for guests
            $sessionCart = $this->getSessionCart();
            $product = Product::findOrFail($productId);

            switch ($action) {
                case CartUpdateAction::Add:
                case CartUpdateAction::Increase:
                    return $this->addProductToSessionCart($sessionCart, $product, $quantity);

                case CartUpdateAction::Remove:
                    return $this->removeProductFromSessionCart($sessionCart, $productId);

                case CartUpdateAction::Decrease:
                    return $this->decreaseProductInSessionCart($sessionCart, $productId, $quantity);

                default:
                    throw new \InvalidArgumentException('Invalid cart action');
            }
        }
    }

    /**
     * Add product to session cart
     *
     * @param array $sessionCart
     * @param Product $product
     * @param int $quantity
     * @return string
     */
    private function addProductToSessionCart(array $sessionCart, Product $product, int $quantity): string
    {
        $products = $sessionCart['products'];

        if (isset($products[$product->id])) {
            $products[$product->id]['quantity'] += $quantity;
        } else {
            $products[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity
            ];
        }

        $sessionCart['products'] = $products;
        $sessionCart['total_price'] = $this->calculateSessionCartTotal($products);

        Session::put(self::SESSION_KEY, $sessionCart);

        return 'Product added to cart';
    }

    /**
     * Remove product from session cart
     *
     * @param array $sessionCart
     * @param int $productId
     * @return string
     */
    private function removeProductFromSessionCart(array $sessionCart, int $productId): string
    {
        $products = $sessionCart['products'];

        if (isset($products[$productId])) {
            unset($products[$productId]);
        }

        $sessionCart['products'] = $products;
        $sessionCart['total_price'] = $this->calculateSessionCartTotal($products);

        Session::put(self::SESSION_KEY, $sessionCart);

        return 'Product removed from cart';
    }

    /**
     * Decrease product quantity in session cart
     *
     * @param array $sessionCart
     * @param int $productId
     * @param int $quantity
     * @return string
     */
    private function decreaseProductInSessionCart(array $sessionCart, int $productId, int $quantity): string
    {
        $products = $sessionCart['products'];

        if (isset($products[$productId])) {
            $products[$productId]['quantity'] = max(0, $products[$productId]['quantity'] - $quantity);

            if ($products[$productId]['quantity'] == 0) {
                unset($products[$productId]);
            }
        }

        $sessionCart['products'] = $products;
        $sessionCart['total_price'] = $this->calculateSessionCartTotal($products);

        Session::put(self::SESSION_KEY, $sessionCart);

        return 'Product quantity decreased';
    }

    /**
     * Calculate total price for session cart
     *
     * @param array $products
     * @return float
     */
    private function calculateSessionCartTotal(array $products): float
    {
        $total = 0;

        foreach ($products as $product) {
            $total += $product['price'] * $product['quantity'];
        }

        return $total;
    }

    /**
     * Get all products in the cart
     *
     * @return array|\Illuminate\Database\Eloquent\Collection
     */
    public function getProducts()
    {
        if (Auth::check()) {
            return Auth::user()->cart->products;
        }

        $sessionCart = $this->getSessionCart();
        return collect($sessionCart['products'])->values();
    }

    /**
     * Empty the cart
     *
     * @return void
     */
    public function emptyCart(): void
    {
        if (Auth::check()) {
            Auth::user()->cart->emptyList();
        } else {
            Session::put(self::SESSION_KEY, [
                'products' => [],
                'total_price' => 0
            ]);
        }
    }

    /**
     * Transfer session cart to user cart on login
     */
    public function transferSessionCartToUser($user): void
    {
        if (!Session::has(self::SESSION_KEY)) {
            return;
        }

        $sessionCart = $this->getSessionCart();
        $cart = $user->cart ?? Cart::factory()->forUser($user)->create();

        foreach ($sessionCart['products'] as $product) {
            $cart->addProduct($product['id'], $product['quantity']);
        }

        // Clear the session cart after transfer
        Session::forget(self::SESSION_KEY);
    }
}
