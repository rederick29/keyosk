<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CompatibilityTag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompatibilityTag>
 */
class CompatibilityTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
        ];
    }
}
