<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
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

    public function forUser(User $user): CartFactory|Factory
    {
        return $this->state(function (array $attributes) use ($user)
        {
            return ['user_id' => $user->id];
        });
    }

    public function forProducts(Collection $products): CartFactory|Factory
    {
        return $this->afterCreating(function (Cart $cart) use ($products)
        {
            $products->each(function (Product $product) use ($cart)
            {
                $cart->products()->attach($product->id, ['quantity' => 1]);
            });
        });
    }
}
