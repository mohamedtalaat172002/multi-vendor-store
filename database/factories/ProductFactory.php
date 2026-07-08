<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\stores;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\product;
/**
 * @extends Factory<product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);
        return [
            'store_id' => stores::query()->inRandomOrder()->value('id'),
            'category_id' => Category::query()->inRandomOrder()->value('id'),
            'name' => $name,
            'slug' => Str::slug($name . '-' . fake()->unique()->numberBetween(1, 9999)),
            'description' => fake()->boolean(80) ? fake()->paragraph() : null,
            'image' => fake()->boolean(80) ? fake()->imageUrl() : null,
            'price' => fake()->randomFloat(2, 50, 5000),
            'compare_price' => fake()->boolean(50) ? fake()->randomFloat(2, 50, 6000) : null,
            'options' => null,
            'rating' => fake()->randomFloat(1, 0, 5),
            'featured' => fake()->boolean(),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
