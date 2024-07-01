<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        return [
            "title" => ucfirst(fake()->words(3, true)),
            "author" => fake()->name(),
            "published_year" => fake()->year(),
            "keywords" => implode(' ', fake()->randomElements(["Action and adventure", "Art/architecture", "Alternate history", "Autobiography", "Anthology", "Biography", "Chick lit", "Business/economics", "Children's", "Crafts/hobbies", "Classic", "Cookbook","Comic book", "Diary", "Coming-of-age", "Dictionary", "Crime", "Encyclopedia", "Drama", "Guide",  "Fairytale", "Health/fitness", "Fantasy", "History", "Graphic novel", "Home and garden", "Historical fiction", "Humor", "Horror", "Journal", "Mystery", "Math", "Paranormal romance", "Memoir", "Picture book", "Philosophy", "Poetry", "Prayer", "Political thriller", "Religion, spirituality, and new age", "Romance", "Textbook", "Satire", "True crime", "Science fiction", "Review", "Short story", "Science", "Suspense", "Self help", "Thriller", "Sports and leisure", "Western", "Travel","Young adult", "True crime"], 3)),
            "description" => fake()->text(200),
            "detail" => fake()->text(100),
            "price" => fake()->numberBetween(10, 300),
            "quantity" => fake()->numberBetween(0, 5000),
            "image" => fake()->randomElement(['assets/images/tab-item1.jpg', 'assets/images/main-banner1.jpg', 'assets/images/main-banner2.jpg', 'assets/images/product-item1.jpg', 'assets/images/product-item2.jpg', 'assets/images/product-item3.jpg', 'assets/images/product-item4.jpg', 'assets/images/product-item5.jpg', 'assets/images/product-item6.jpg', 'assets/images/product-item7.jpg', 'assets/images/product-item8.jpg', 'assets/images/tab-item1.jpg', 'assets/images/tab-item2.jpg', 'assets/images/tab-item3.jpg', 'assets/images/tab-item4.jpg', 'assets/images/tab-item5.jpg', 'assets/images/tab-item6.jpg', 'assets/images/tab-item7.jpg', 'assets/images/tab-item8.jpg', 'assets/images/1.png', 'assets/images/2.png', 'assets/images/3.png', 'assets/images/4.png', 'assets/images/5.png', 'assets/images/6.png', 'assets/images/7.png', 'assets/images/8.png', 'assets/images/9.png', 'assets/images/10.png','assets/images/11.png', 'assets/images/12.png', 'assets/images/13.png', 'assets/images/14.png', 'assets/images/15.png', 'assets/images/16.png', 'assets/images/17.png', 'assets/images/18.png', 'assets/images/19.png','assets/images/20.png','assets/images/21.png','assets/images/22.png','assets/images/23.png','assets/images/24.png','assets/images/25.png','assets/images/26.png','assets/images/27.png','assets/images/28.png','assets/images/29.png','assets/images/30.png','assets/images/31.png','assets/images/32.png','assets/images/33.png','assets/images/34.png','assets/images/35.png','assets/images/36.png','assets/images/37.png','assets/images/38.png','assets/images/39.png','assets/images/40.png','assets/images/41.png','assets/images/42.png','assets/images/43.png','assets/images/44.png','assets/images/45.png','assets/images/46.png','assets/images/47.png','assets/images/48.png','assets/images/49.png','assets/images/50.png','assets/images/51.png','assets/images/52.png','assets/images/53.png', 'assets/images/54.png','assets/images/55.png','assets/images/56.png','assets/images/57.png','assets/images/58.png','assets/images/59.png','assets/images/60.png','assets/images/61.png','assets/images/62.png','assets/images/63.png','assets/images/65.png','assets/images/66.png','assets/images/67.png']),
            "category_id" => $this->faker->randomElement(Category::all())['id'],
            "user_id" => $this->faker->randomElement(User::all())["id"],
            "status" => $this->faker->boolean(90),
        ];
    }
}
