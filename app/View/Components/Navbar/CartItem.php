<?php

namespace App\View\Components\Navbar;

use App\Models\Product;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CartItem extends Component
{
    public int $productId;
    public string $productImage;
    public string $productTitle;
    public float $productPrice;
    public int $productQuantity;

    /**
     * Create a new component instance.
     * @throws Exception
     */
    public function __construct(Product $product)
    {
        $this->productId = $product->id;
        if(empty($this->productId))
        {
            throw new Exception("Product id should not be null");
        }

        $this->productImage = $product->primaryImageLocation() ?? 'Undefined';
        if(empty($this->productImage))
        {
            throw new Exception("Product image should not be null");
        }

        $this->productTitle = $product->name;
        if(empty($this->productTitle))
        {
            throw new Exception("Product title should not be null");
        }

        $this->productPrice = $product->price;
        if(empty($this->productPrice) || $this->productPrice < 0)
        {
           throw new Exception("Product price should not be null or less than 0");
        }

        $this->productQuantity = Auth::user()->cart->getProductQuantity($this->productId);
        if(empty($this->productQuantity) || $this->productQuantity <= 0)
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
