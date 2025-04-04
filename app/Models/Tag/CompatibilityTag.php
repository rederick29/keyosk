<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompatibilityTag extends Model
{
    use hasFactory;

    protected $fillable = ['description'];

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
