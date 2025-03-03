<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ColourTag extends Model
{
    use hasFactory;

    protected $fillable = ['hex_code'];

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
