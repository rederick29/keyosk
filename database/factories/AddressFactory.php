<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::all()->random();
        $max_priority = $user->addresses->max('priority');
        return [
            'user_id' => $user->id,
            // default to account's name
            'name' => $user->name,
            'line_one' => $this->faker->streetAddress(),
            'line_two' => null,
            'city' => $this->faker->city(),
            'postcode' => $this->faker->postcode(),
            'country_id' => Country::all()->random()->id,
            'priority' => $max_priority + 1 ?? 0,
        ];
    }

    public function withoutUserSaved(User $user): Factory|AddressFactory
    {
        return $this->state(function (array $attributes) use ($user){
            return [
                'user_id' => $user->id,
                'name' => $user->name,
                'priority' => null,
                'deleted_at' => DB::raw('CURRENT_TIMESTAMP'),
            ];
        });
    }

    public function forUser(User $user): Factory|AddressFactory
    {
        return $this->state(function (array $attributes) use ($user)
        {
            return [
                'user_id' => $user->id,
                'name' => $user->name,
                'priority' => $user->addresses()->max('priority') + 1 ?? 0,
            ];
        });
    }
}
