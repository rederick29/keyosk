<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Tag;
use App\Models\Tag\ColourTag;
use App\Models\Tag\CompatibilityTag;
use App\Models\Tag\AttributeTag;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'short_description',
        'description',
        'stock',
        'price',
    ];

    public function primaryImageLocation(): String | null
    {
        $image = $this->images->where('priority', '=', 0)->first();
        return $image ? $image->location : null;
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

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }

    public function colourTags(): BelongsToMany
    {
        return $this->belongsToMany(ColourTag::class, 'product_tag', 'product_id', 'tag_id');
    }

    public function attributeTags(): BelongsToMany
    {
        return $this->belongsToMany(AttributeTag::class, 'product_tag', 'product_id', 'tag_id');
    }

    public function compatibilityTags(): BelongsToMany
    {
        return $this->belongsToMany(CompatibilityTag::class, 'product_tag', 'product_id', 'tag_id');
    }
}
