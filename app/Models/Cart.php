<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;

    public function getProductQuantity($productId): int | null
    {
        $product = $this->products()->where('products.id', $productId)->first();
        if (!$product) {
            return null;
        }
        return $product->pivot->quantity;
    }

    public function getTotalPrice(): float
    {
        $price = 0.0;
        foreach($this->products()->all() as $product) {
            $price += $product->price * $this->products()->where('products.id', $product->id)->first()->pivot->quantity;
        }
        return $price;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
