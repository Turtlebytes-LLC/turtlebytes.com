<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        $slug  = Str::of($title)->slug();

        return [
            'title' => $title,
            'slug'  => $slug,
            'tags'  => Str::of($title)->explode(' ')->toArray() + ['factory', 'test'],

            'author_id' => '1',

            'body' => $this->faker->paragraphs(3, true),
        ];
    }
}
