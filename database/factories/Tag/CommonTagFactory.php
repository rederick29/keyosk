<?php

namespace Database\Factories\Tag;

use App\Models\Tag;
use App\Models\Tag\TagType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
abstract class CommonTagFactory extends Factory
{
    protected TagType $tag_type;

    public function withName(string $name): self|Factory
    {
        return $this->state(function (array $attributes) use ($name) {
            return [
                'tag_id' => Tag::where([['name', $name], ['type', $this->tag_type]])
                    ->firstOrCreate(['name' => $name, 'type' => $this->tag_type])
                    ->id,
            ];
        });
    }
}
