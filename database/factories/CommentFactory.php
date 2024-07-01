<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => $this->faker->randomElement(User::all())["id"],
            "product_id" => $this->faker->randomElement(Product::all())["id"],
            "subject" => fake()->text(95),
            "review" => fake()->text(250),
            "IP" => null,
            "rate" => fake()->numberBetween(1, 5),
            "status" => $this->faker->boolean(90),
        ];
    }
}
