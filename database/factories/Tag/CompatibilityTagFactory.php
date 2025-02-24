<?php

namespace Database\Factories\Tag;

use App\Models\Tag;
use App\Models\Tag\CompatibilityTag;
use App\Models\Tag\TagType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class CompatibilityTagFactory extends CommonTagFactory
{
    protected TagType $tag_type = TagType::Compatibility;
    protected $model = CompatibilityTag::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->sentence(),
            'tag_id' => Tag::factory()->state(['type' => $this->tag_type]),
        ];
    }
}
