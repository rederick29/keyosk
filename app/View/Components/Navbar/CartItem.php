<?php

namespace App\View\Components\Navbar;

use Illuminate\View\Component;

class CartItem extends Component
{
    public $productImage;
    public $productTitle;
    public $productPrice;
    public $productQuantity;

    public function __construct($productImage, $productTitle, $productPrice, $productQuantity)
    {
        $this->productImage = $productImage;
        $this->productTitle = $productTitle;
        $this->productPrice = $productPrice;
        $this->productQuantity = $productQuantity;
    }

    public function render() {
        return view('components.navbar.cart-item');
    }
}
