<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order\OrderStatus;
use Illuminate\Support\Collection;

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
            'email' => $user->email,
            'total_price' => fake()->randomFloat(2, 10, 100),
        ];
    }

    public function forUser(User $user): Factory|OrderFactory
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                'user_id' => $user->id,
                'email' => $user->email,
                'address_id' => $user->addresses->random(),
            ];
        });
    }

    public function forProducts(Collection $products, int $quantity = 1): Factory|OrderFactory
    {
        return $this->afterCreating(function (Order $order) use ($products, $quantity) {
            $total_price = 0;

            $products->each(function (Product $product) use ($order, &$total_price, $quantity) {
                $price = $product->price;

                $order->products()->attach($product->id, [
                    'price' => $price,
                    'quantity' => $quantity,
                ]);

                $total_price += $price * $quantity;
            });

            $order->update(['total_price' => $total_price]);
        });
    }
}
