<?php

namespace Database\Factories\Tag;

use App\Models\Tag;
use App\Models\Tag\AttributeTag;
use App\Models\Tag\TagType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
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
            'description' => fake()->sentence(),
            'tag_id' => Tag::factory()->state(['type' => TagType::Attribute]),
        ];
    }
}
