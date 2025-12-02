<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $books = Book::all();

        if ($books->isEmpty()) {
            $this->call([
                SellerSeeder::class,
                BookSeeder::class,
            ]);
            $books = Book::all();
        }

        foreach ($books as $book) {
            Review::factory()->count(3)->create([
                'book_id' => $book->id,
            ]);
        }
    }
}
