<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * Class Review
 *
 * @package App\Models
 */
class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rating',
        'subject',
        'comment',
        'user_id',
        'product_id',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::saving(function (Review $review) {
            if ($review->rating < 0 || $review->rating > 10) {
                throw new ValidationException('Rating must be between 0 and 10');
            }
        });
    }

    public static function findReview(int $productId, int $userId): self | null
    {
        return Review::where('product_id', $productId)->where('user_id', $userId)->first();
    }

    /**
     * Get the user that owns the review.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product that the review belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
