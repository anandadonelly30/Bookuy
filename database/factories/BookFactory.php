<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(3);
        $author = $this->faker->name();
        $fileName = Str::slug($title . '-' . $author) . '-' . $this->faker->unique()->numerify('###') . '.jpg';

        return [
            'seller_id' => Seller::factory(),
            'title' => $title,
            'author' => $author,
            'price_buy' => $this->faker->numberBetween(40000, 120000),
            'price_rent' => $this->faker->numberBetween(15000, 60000),
            'price' => $this->faker->numberBetween(40000, 120000),
            'cover' => $fileName,
            'cover_image_url' => 'images/books/' . $fileName,
            'short_description' => $this->faker->sentence(8),
            'full_description' => $this->faker->paragraph(3),
            'address' => $this->faker->city(),
            'condition' => $this->faker->randomElement(['Bekas Premium', 'Bekas Terawat', 'Bekas Seperti Baru']),
            'category' => $this->faker->randomElement(['Manajemen Proses Bisnis', 'Pemrograman', 'Sistem Enterprise', 'Analitik Data']),
            'pages' => $this->faker->numberBetween(200, 700),
            'rating_average' => 0,
            'rating_count' => 0,
            'is_recommended' => $this->faker->boolean(60),
            'popularity_score' => $this->faker->numberBetween(50, 100),
        ];
    }
}
