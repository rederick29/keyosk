<?php

namespace Database\Factories;

use App\Models\Subscription\SubscriptionTiers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tier' => fake()->randomElement(SubscriptionTiers::getEnumValues()),
            'user_id' => fake()->unique()->randomElement(User::all()),
            'started_at' => Carbon::now()->toDateTimeString(),
            'ends_at' => Carbon::now()->addMonth()->toDateTimeString(),
        ];
    }
}
