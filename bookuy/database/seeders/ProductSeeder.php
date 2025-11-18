<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Matematika
            [
                'name' => 'Matematika I',
                'description' => 'Buku Matematika Dasar untuk semester 1',
                'price' => 75000,
                'image_url' => '/images/books/Matematika.jpg',
                'category' => 'book',
                'mata_kuliah' => 'Matematika',
                'location' => 'Jakarta',
                'author' => 'Dr. Ahmad',
                'stock' => 10,
                'type' => 'sell'
            ],
            [
                'name' => 'Matematika I',
                'description' => 'Sewa Buku Matematika Dasar untuk semester 1',
                'price' => 15000,
                'image_url' => '/images/books/Matematika.jpg',
                'category' => 'book',
                'mata_kuliah' => 'Matematika',
                'location' => 'Bandung',
                'author' => 'Dr. Ahmad',
                'stock' => 5,
                'type' => 'rent'
            ],
            // MPB (Manajemen Proses Bisnis)
            [
                'name' => 'MPB Fundamental',
                'description' => 'Fundamental Manajemen Proses Bisnis untuk Mahasiswa',
                'price' => 85000,
                'image_url' => '/images/books/Manajemen Proses Bisnis.jpg',
                'category' => 'book',
                'mata_kuliah' => 'MPB',
                'location' => 'Jakarta',
                'author' => 'Prof. Siti',
                'stock' => 8,
                'type' => 'sell'
            ],
            [
                'name' => 'MPB Fundamental',
                'description' => 'Sewa Buku Manajemen Proses Bisnis untuk Mahasiswa',
                'price' => 17000,
                'image_url' => '/images/books/Manajemen Proses Bisnis.jpg',
                'category' => 'book',
                'mata_kuliah' => 'MPB',
                'location' => 'Surabaya',
                'author' => 'Prof. Siti',
                'stock' => 3,
                'type' => 'rent'
            ],
            // Fisika Dasar
            [
                'name' => 'Fisika Dasar I',
                'description' => 'Buku Fisika Dasar untuk semester awal',
                'price' => 95000,
                'image_url' => '/images/books/Fisika Dasar.jpg',
                'category' => 'book',
                'mata_kuliah' => 'Fisika',
                'location' => 'Jakarta',
                'author' => 'Prof. Budi',
                'stock' => 12,
                'type' => 'sell'
            ],
            // Kimia Dasar
            [
                'name' => 'Kimia Dasar I',
                'description' => 'Pengantar Kimia untuk Mahasiswa',
                'price' => 89000,
                'image_url' => '/images/books/kimia dasar.jpg',
                'category' => 'book',
                'mata_kuliah' => 'Kimia',
                'location' => 'Bandung',
                'author' => 'Dr. Dewi',
                'stock' => 7,
                'type' => 'sell'
            ],
            // PWEB (Pemrograman Web)
            [
                'name' => 'Pemrograman Web',
                'description' => 'Web Dasar dengan HTML, CSS, dan JavaScript',
                'price' => 120000,
                'image_url' => '/images/books/Pemrograman web.jpg',
                'category' => 'book',
                'mata_kuliah' => 'PWEB',
                'location' => 'Jakarta',
                'author' => 'Ir. Andi',
                'stock' => 15,
                'type' => 'sell'
            ],
            // Pemrograman
            [
                'name' => 'Dasar Pemrograman',
                'description' => 'Konsep Dasar Pemrograman untuk Pemula',
                'price' => 95000,
                'image_url' => '/images/books/Pemgrograman.png',
                'category' => 'book',
                'mata_kuliah' => 'Pemrograman',
                'location' => 'Jakarta',
                'author' => 'Dr. Rahman',
                'stock' => 9,
                'type' => 'sell'
            ],
            // SKPB (Sistem Komputer dan Basis Data)
            [
                'name' => 'Database Fundamentals',
                'description' => 'Fundamental Database untuk SKPB',
                'price' => 110000,
                'image_url' => '/images/books/Matematika.jpg',
                'category' => 'book',
                'mata_kuliah' => 'SKPB',
                'location' => 'Surabaya',
                'author' => 'Prof. Hendra',
                'stock' => 6,
                'type' => 'sell'
            ],
            [
                'name' => 'Fundamental MPB',
                'description' => 'Materi Pengantar Manajemen Proses Bisnis',
                'price' => 78000,
                'image_url' => '/images/books/Manajemen Proses Bisnis.jpg',
                'category' => 'book',
                'mata_kuliah' => 'MPB',
                'location' => 'Jakarta',
                'author' => 'Dr. Lisa',
                'stock' => 11,
                'type' => 'sell'
            ],
            // Additional products for variety
            [
                'name' => 'Kalkulus Lanjut',
                'description' => 'Buku Kalkulus untuk mahasiswa tingkat lanjut',
                'price' => 98000,
                'image_url' => '/images/books/Matematika.jpg',
                'category' => 'book',
                'mata_kuliah' => 'Matematika',
                'location' => 'Bandung',
                'author' => 'Prof. Agus',
                'stock' => 4,
                'type' => 'sell'
            ],
            [
                'name' => 'Algoritma & Pemrograman',
                'description' => 'Dasar-dasar Algoritma dan Pemrograman',
                'price' => 105000,
                'image_url' => '/images/books/Pemgrograman.png',
                'category' => 'book',
                'mata_kuliah' => 'SKPB',
                'location' => 'Jakarta',
                'author' => 'Ir. Yanto',
                'stock' => 14,
                'type' => 'sell'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
