<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wishlist>
 */
class WishlistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
        ];
    }

    public function forUser(User $user): WishlistFactory|Factory
    {
        return $this->state(function (array $attributes) use ($user)
        {
            return ['user_id' => $user->id];
        });
    }

    public function forProducts(Collection $products): WishlistFactory|Factory
    {
        return $this->afterCreating(function (Wishlist $wishlist) use ($products)
        {
            $products->each(function (Product $product) use ($wishlist)
            {
                $wishlist->products()->attach($product->id);
            });
        });
    }
}
