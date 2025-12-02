<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'book_id' => Book::factory(),
            'reviewer_name' => $this->faker->name(),
            'stars' => $this->faker->numberBetween(3, 5),
            'comment' => $this->faker->sentence(12),
        ];
    }
}
