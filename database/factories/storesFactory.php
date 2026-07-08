<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\stores;
use Illuminate\Support\Str;
/**
 * @extends Factory<stores>
 */
class storesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(2, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(15),
            'logo_image' => $this->faker->imageUrl(300, 300),
            'cover_image' => $this->faker->imageUrl(800, 600),
            'status' => fake()->randomElement(['active', 'inactive'])
        ];
    }
}
