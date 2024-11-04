<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ColourTag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ColourTag>
 */
class ColourTagFactory extends Factory
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
