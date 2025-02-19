<?php

namespace Database\Factories\Tag;

use App\Models\Tag;
use App\Models\Tag\ColourTag;
use App\Models\Tag\TagType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class ColourTagFactory extends CommonTagFactory
{
    protected $model = ColourTag::class;
    protected TagType $tag_type = TagType::Colour;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hex_code' => fake()->hexColor(),
            'tag_id' => Tag::factory()->state(['type' => $this->tag_type]),
        ];
    }

}
