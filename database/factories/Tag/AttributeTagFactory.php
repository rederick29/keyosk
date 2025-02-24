<?php

namespace Database\Factories\Tag;

use App\Models\Tag;
use App\Models\Tag\AttributeTag;
use App\Models\Tag\TagType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class AttributeTagFactory extends CommonTagFactory
{
    protected $model = AttributeTag::class;
    protected TagType $tag_type = TagType::Attribute;

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
