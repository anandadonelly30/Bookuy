<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use App\Models\Seller;
use Illuminate\Database\Seeder;

class BookuyDemoSeeder extends Seeder
{
    public function run(): void
    {
        $seller = Seller::create([
            'name' => 'Missy Tiffany',
            'role' => 'Mahasiswi Semester 6',
            'avatar' => 'https://images.unsplash.com/photo-1544723795-3fb6469f5b39?auto=format&fit=crop&w=200&q=80',
            'about' => 'Penggemar buku manajemen proses bisnis yang senang berbagi koleksi pribadi yang masih terawat rapi.',
        ]);

        $books = [
            [
                'seller_id' => $seller->id,
                'title' => 'Fundamental Manajemen Proses Bisnis',
                'author' => 'Marlon Dumas',
                'price_buy' => 50000,
                'price_rent' => 20000,
                'price' => 50000,
                'cover' => 'https://images.unsplash.com/photo-1544717300-987c3d9d546d?auto=format&fit=crop&w=600&q=80',
                'cover_image_url' => 'https://images.unsplash.com/photo-1544717300-987c3d9d546d?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Dasar menyeluruh untuk memahami MPB modern.',
                'full_description' => 'Buku ini membahas konsep inti dan studi kasus mengenai manajemen proses bisnis serta panduan mengoptimalkan alur kerja lintas departemen.',
                'address' => 'Sukolilo, Surabaya',
                'condition' => 'Bekas Premium',
                'category' => 'Manajemen Proses Bisnis',
                'pages' => 642,
                'rating_average' => 4.2,
                'rating_count' => 4,
                'is_recommended' => true,
                'popularity_score' => 90,
            ],
            [
                'seller_id' => $seller->id,
                'title' => 'Sistem Enterprise Terintegrasi',
                'author' => 'Mahmoudwafi, Ph.D',
                'price_buy' => 60000,
                'price_rent' => 25000,
                'price' => 60000,
                'cover' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=600&q=80',
                'cover_image_url' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=600&q=80',
                'short_description' => 'Strategi integrasi sistem untuk bisnis skala besar.',
                'full_description' => 'Menyajikan pendekatan arsitektur dan integrasi modul ERP agar organisasi tetap gesit menghadapi perubahan pasar.',
                'address' => 'Darmo, Surabaya',
                'condition' => 'Bekas Seperti Baru',
                'category' => 'Sistem Enterprise',
                'pages' => 520,
                'rating_average' => 4.5,
                'rating_count' => 6,
                'is_recommended' => true,
                'popularity_score' => 88,
            ],
        ];

        foreach ($books as $bookData) {
            $book = Book::create($bookData);

            Review::create([
                'book_id' => $book->id,
                'reviewer_name' => 'Pembeli 1',
                'stars' => 5,
                'comment' => 'Buku datang cepat dan masih sangat bagus.',
            ]);

            Review::create([
                'book_id' => $book->id,
                'reviewer_name' => 'Gajah Anonymous',
                'stars' => 4,
                'comment' => 'Seller ramah, buku dikemas rapi.',
            ]);
        }
    }
}
