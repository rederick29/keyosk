<?php

namespace App\View\Components\Navbar;

use App\Models\Product;
use App\View\Components\ProductComponent;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class CartItem extends ProductComponent
{
    public int $productQuantity;

    /**
     * Create a new component instance.
     * @throws Exception
     */
    public function __construct(Product $product)
    {
        parent::__construct($product);

        $this->productQuantity = Auth::user()->cart->getProductQuantity($this->productId);
        if($this->productQuantity == null || $this->productQuantity <= 0)
        {
            throw new Exception("Product quantity should not be null or 0");
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar.cart-item');
    }
}
