<?php

namespace App\Models;

use App\Models\Tag\TagType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Tag;
use App\Models\Tag\ColourTag;
use App\Models\Tag\CompatibilityTag;
use App\Models\Tag\AttributeTag;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'short_description',
        'description',
        'stock',
        'price',
        'hidden',
    ];

    public function primaryImageLocation(): String | null
    {
        $image = $this->images->where('priority', '=', 0)->first();
        return $image ? $image->location : null;
    }

    public static function findOrderedBy(int $productId, User $user): self | null
    {
        return Product::query()
            ->join('order_product', 'order_product.product_id', '=', 'products.id')
            ->join('orders', 'orders.id', '=', 'order_product.order_id')
            ->where(function ($q) use ($productId, $user) {
                $q->where('products.id', '=', $productId)
                    ->where('orders.user_id', '=', $user->id);
            })->first();
    }

    public function getAverageRating(): float
    {
        $rating = $this->reviews()->select('rating')->avg('rating');
        return $rating ?? 0;
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function wishlists(): BelongsToMany
    {
        return $this->belongsToMany(Wishlist::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id')
            ->withTimestamps();
    }

    public function colourTags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)
            ->whereHas('colourTag');
    }

    public function attributeTags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)
            ->whereHas('attributeTag');
    }

    public function compatibilityTags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)
            ->whereHas('compatibilityTag');
    }
}
