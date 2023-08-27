<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1,100),
            'title' => fake()->sentence(5, true),
            'description' => fake()->paragraph(3,true),
            'url' => fake()->image('public/storage/images', 1920, 1080, 'cats', false),
            'is_private' => fake()->boolean(15)
        ];
    }
}
