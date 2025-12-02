<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            // Matematika
            [
                'name' => 'Matematika I',
                'description' => 'Buku Matematika I untuk semester 1',
                'price' => 75000,
                'image_url' => '/images/books/Matematika.jpg',
                'category' => 'Matematika',
                'mata_kuliah' => 'Matematika',
                'location' => 'Bandung',
                'author' => 'Dr. Siti Nurhaliza',
                'stock' => 15,
                'type' => 'sell'
            ],
            [
                'name' => 'Matematika I',
                'description' => 'Buku Matematika I untuk semester 1 (Rental)',
                'price' => 15000,
                'image_url' => '/images/books/Matematika.jpg',
                'category' => 'Matematika',
                'mata_kuliah' => 'Matematika',
                'location' => 'Bandung',
                'author' => 'Dr. Siti Nurhaliza',
                'stock' => 10,
                'type' => 'rent'
            ],
            
            // MPB
            [
                'name' => 'MPB Fundamental',
                'description' => 'Manajemen Proses Bisnis untuk pemula',
                'price' => 85000,
                'image_url' => '/images/books/Manajemen Proses Bisnis.jpg',
                'category' => 'MPB',
                'mata_kuliah' => 'MPB',
                'location' => 'Jakarta',
                'author' => 'Prof. Ahmad Yani',
                'stock' => 20,
                'type' => 'sell'
            ],
            [
                'name' => 'MPB Fundamental MPB',
                'description' => 'Manajemen Proses Bisnis untuk pemula (Rental)',
                'price' => 25000,
                'image_url' => '/images/books/Manajemen Proses Bisnis.jpg',
                'category' => 'MPB',
                'mata_kuliah' => 'MPB',
                'location' => 'Jakarta',
                'author' => 'Prof. Ahmad Yani',
                'stock' => 8,
                'type' => 'rent'
            ],
            
            // Pemrograman Web
            [
                'name' => 'Pemrograman Web',
                'description' => 'Belajar HTML, CSS, JavaScript',
                'price' => 95000,
                'image_url' => '/images/books/Pemrograman web.jpg',
                'category' => 'PWEB',
                'mata_kuliah' => 'PWEB',
                'location' => 'Surabaya',
                'author' => 'Budi Santoso',
                'stock' => 12,
                'type' => 'sell'
            ],
            [
                'name' => 'Pemrograman Web Rental',
                'description' => 'Belajar HTML, CSS, JavaScript (Rental)',
                'price' => 30000,
                'image_url' => '/images/books/Pemgrograman.png',
                'category' => 'PWEB',
                'mata_kuliah' => 'PWEB',
                'location' => 'Surabaya',
                'author' => 'Budi Santoso',
                'stock' => 7,
                'type' => 'rent'
            ],
            
            // Software Engineering
            [
                'name' => 'Software Engineering Principles',
                'description' => 'Prinsip-prinsip rekayasa perangkat lunak',
                'price' => 120000,
                'image_url' => '/images/books/SE.jpg',
                'category' => 'SE',
                'mata_kuliah' => 'SE',
                'location' => 'Bandung',
                'author' => 'Dr. Rina Wijaya',
                'stock' => 8,
                'type' => 'sell'
            ],
            
            // SKPB
            [
                'name' => 'SKPB Dasar',
                'description' => 'Sistem Komputasi Paralel dan Berimbang',
                'price' => 90000,
                'image_url' => '/images/books/SKPB.jpg',
                'category' => 'SKPB',
                'mata_kuliah' => 'SKPB',
                'location' => 'Jakarta',
                'author' => 'Prof. Andi Setiawan',
                'stock' => 10,
                'type' => 'sell'
            ],
            
            // Fisika
            [
                'name' => 'Fisika Dasar',
                'description' => 'Fisika dasar untuk mahasiswa teknik',
                'price' => 80000,
                'image_url' => '/images/books/Fisika Dasar.jpg',
                'category' => 'Fisika',
                'mata_kuliah' => 'Fisika',
                'location' => 'Bandung',
                'author' => 'Dr. Hendra Kusuma',
                'stock' => 14,
                'type' => 'sell'
            ],
            
            // Kimia
            [
                'name' => 'Kimia Organik',
                'description' => 'Kimia organik untuk mahasiswa farmasi',
                'price' => 110000,
                'image_url' => '/images/books/kimia dasar.jpg',
                'category' => 'Kimia',
                'mata_kuliah' => 'Kimia',
                'location' => 'Surabaya',
                'author' => 'Dra. Sri Mulyani',
                'stock' => 9,
                'type' => 'sell'
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
