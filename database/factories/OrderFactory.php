<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order\OrderStatus;
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
        return [
            'status' => $this->faker->randomElement(OrderStatus::getEnumValues()),
            'user_id' => $this->faker->randomElement(DB::Table('users')->pluck('id')),
            'total_price' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
