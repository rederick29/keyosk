<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductComponent extends Component
{
    public int $productId;
    public string $productImage;
    public string $productTitle;
    public float $productPrice;

    /**
     * Create a new component instance.
     * @throws Exception
     */
    public function __construct(Product $product)
    {
        if ($product === null) {
            throw new Exception('Product not found');
        }

        $this->productId = $product->id;
        if(empty($this->productId))
        {
            throw new Exception("Product ID should not be null");
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
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('index');
    }
}

