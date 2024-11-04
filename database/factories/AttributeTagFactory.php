<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AttributeTag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AttributeTag>
 */
class AttributeTagFactory extends Factory
{
    protected $model = AttributeTag::class;
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
