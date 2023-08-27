<?php

namespace Database\Factories;

use App\Models\Blog;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends Factory<Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @throws Exception
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        $slug  = Str::of($title)->slug();

        return [
            'title'       => $title,
            'slug'        => $slug,
            'description' => $this->faker->paragraph(),
            'tags'        => Str::of($title)->explode(' ')->toArray() + ['factory', 'test'],

            'author_id' => '1',
        ];
    }
}
