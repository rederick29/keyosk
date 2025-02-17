<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order\OrderStatus;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::all()->random();
        return [
            'status' => fake()->randomElement(OrderStatus::getEnumValues()),
            'user_id' => $user->id,
            'address_id' => $user->addresses->random(),
            'total_price' => fake()->randomFloat(2, 10, 100),
        ];
    }

    public function forUser(User $user): Factory|OrderFactory
    {
        return $this->state(function (array $attributes) use ($user)
        {
           return [
               'user_id' => $user->id,
               'address_id' => $user->addresses->random(),
           ];
        });
    }

    public function forProducts(Collection $products): Factory|OrderFactory
    {
        return $this->state(function (array $attributes) use ($products)
        {
            $total_price = $products->map(function(Product $product)
            {
                return $product->price;
            })->sum();

            return [
                'total_price' => $total_price,
            ];
        })->afterCreating(function (Order $order) use ($products)
        {
            $products->each(function (Product $product) use ($order)
            {
                $order->products()->attach($product->id, [
                    'price' => $product->price,
                    'quantity' => 1,
                ]);
            });
        });
    }
}
