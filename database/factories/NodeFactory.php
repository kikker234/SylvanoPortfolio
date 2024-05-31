<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Node>
 */
class NodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $randomWidth = random_int(200, 800);
        $randomHeight = random_int(200, 800);
        $placeHolderImage = "https://via.placeholder.com/{$randomWidth}x{$randomHeight}";

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'image' => $placeHolderImage,
        ];
    }
}
