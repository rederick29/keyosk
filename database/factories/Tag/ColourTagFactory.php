<?php

namespace Database\Factories\Tag;

use App\Models\Tag;
use App\Models\Tag\ColourTag;
use App\Models\Tag\TagType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class ColourTagFactory extends Factory
{
    protected $model = ColourTag::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hex_code' => fake()->hexColor(),
            'tag_id' => Tag::factory()->state(['type' => TagType::Colour->value]),
        ];
    }
}
