<?php

namespace App\View\Components\Util;

use App\Models\Product;
use App\View\Components\ProductComponent;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;

class ProductCard extends ProductComponent
{
    public string $productShortDescription;

    /**
     * Create a new component instance.
     * @throws Exception
     */
    public function __construct(Product $product)
    {
        parent::__construct($product);

        $this->productShortDescription = $product->short_description;
        if(empty($this->productShortDescription))
        {
            throw new Exception("Product short description should be null");
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.util.product-card');
    }
}

