<?php

namespace App\Models\ProductList;

use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPivot extends Pivot
{
    public const extra_columns = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
