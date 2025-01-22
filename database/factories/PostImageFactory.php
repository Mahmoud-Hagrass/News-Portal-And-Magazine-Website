<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostImage>
 */
class PostImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomId = fake()->numberBetween(1, 1000); // Random ID for unique images
        
        return [
            'image' => "https://picsum.photos/640/480?random={$randomId}", // Dynamic image URL
        ];
    }
}
