<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect([
            ['name' => 'Manajemen Proses Bisnis', 'icon' => '📊'],
            ['name' => 'Pemrograman', 'icon' => '💻'],
            ['name' => 'Bisnis', 'icon' => '📈'],
            ['name' => 'Teknologi', 'icon' => '🛰️'],
            ['name' => 'Data & Analytics', 'icon' => '📉'],
        ])->mapWithKeys(function (array $category) {
            $model = Category::create($category);
            return [$model->name => $model->id];
        });

        $books = [
            [
                'title' => 'Fundamental Manajemen Proses Bisnis',
                'author' => 'Marlon Dumas',
                'price' => 50000,
                'cover_image_url' => 'https://images.unsplash.com/photo-1544717300-987c3d9d546d?auto=format&fit=crop&w=600&q=80',
                'is_recommended' => true,
                'popularity_score' => 90,
                'categories' => ['Manajemen Proses Bisnis', 'Bisnis'],
            ],
            [
                'title' => 'Sistem Enterprise Terintegrasi',
                'author' => 'Mahmoudwafi, Ph.D',
                'price' => 60000,
                'cover_image_url' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=600&q=80',
                'is_recommended' => true,
                'popularity_score' => 88,
                'categories' => ['Teknologi', 'Bisnis'],
            ],
            [
                'title' => 'Analytics Playbook',
                'author' => 'Kim Taylor',
                'price' => 55000,
                'cover_image_url' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=600&q=80',
                'is_recommended' => false,
                'popularity_score' => 80,
                'categories' => ['Data & Analytics', 'Bisnis'],
            ],
            [
                'title' => 'Pengantar Pemrograman',
                'author' => 'Rina Paramita',
                'price' => 45000,
                'cover_image_url' => 'https://images.unsplash.com/photo-1529148482759-b35b25c5f147?auto=format&fit=crop&w=600&q=80',
                'is_recommended' => true,
                'popularity_score' => 84,
                'categories' => ['Pemrograman', 'Teknologi'],
            ],
        ];

        foreach ($books as $bookData) {
            $categoryNames = $bookData['categories'];
            unset($bookData['categories']);

            $book = Book::create($bookData);

            $book->categories()->attach(
                collect($categoryNames)
                    ->map(fn ($name) => $categories[$name] ?? null)
                    ->filter()
                    ->all()
            );
        }
    }
}
