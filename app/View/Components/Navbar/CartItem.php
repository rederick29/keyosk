<?php

namespace App\View\Components\Navbar;

use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartItem extends Component
{
    public string $productImage;
    public string $productTitle;
    public int $productPrice;
    public int $productQuantity;

    /**
     * Create a new component instance.
     * @throws Exception
     */
    public function __construct(string $productImage, string $productTitle, int $productPrice, int $productQuantity)
    {
        // assign all parameters
        $this->productImage = $productImage;
        if($this->productImage == null || $this->productImage == '')
        {
            throw new Exception("product image should not be null");
        }

        $this->productTitle = $productTitle;
        if($this->productTitle == null || $this->productTitle == '')
        {
            throw new Exception("product title should not be null");
        }

        $this->productPrice = $productPrice;
        if($this->productPrice == null || $this->productPrice == '' || $this->productPrice < 0)
        {
           throw new Exception("product price should not be null or less than 0");
        }

        $this->productQuantity = $productQuantity;
        if($this->productQuantity == null || $this->productQuantity == '' || $this->productQuantity <= 0)
        {
            throw new Exception("product quantity should not be null or 0");
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
