<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Category::factory(50)->create();

        $categories = Category::skip(10)->limit(40)->get();
        $categories->each(function ($category_update, $key) {
            $category_update->parent_id = fake()->numberBetween(1, 10);
            $category_update->save();
        });

        $categories2 = Category::inRandomOrder()->offset(10)->limit(10)->get();
        $categories2->each(function ($category_update, $key) {
            $category_update->parent_id = fake()->numberBetween(11, 20);
            $category_update->save();
        });

        Product::factory(500)->create();
        Comment::factory(700)->create();
    }
}
