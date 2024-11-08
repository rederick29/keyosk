<?php

namespace App\Models;

use App\Models\Tag\AttributeTag;
use App\Models\Tag\ColourTag;
use App\Models\Tag\CompatibilityTag;
use App\Models\Tag\TagType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    protected $casts = [
        'type' => TagType::class,
    ];

    protected $fillable = ['type', 'name'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_tag');
    }

    public function colourTag(): HasOne
    {
        return $this->hasOne(ColourTag::class);
    }

    public function attributeTag(): HasOne
    {
        return $this->hasOne(AttributeTag::class);
    }

    public function compatibilityTag(): HasOne
    {
        return $this->hasOne(CompatibilityTag::class);
    }
}
