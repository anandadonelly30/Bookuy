<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Matematika Dasar',
            'author' => 'John Doe',
            'category' => 'Matematika',
            'condition' => 'Baik',
            'sell_price' => 45000,
            'rent_price' => 10000,
            'image_url' => 'books/matematika_dasar.png',
        ]);

        Book::create([
            'title' => 'Manajemen Proses Bisnis',
            'author' => 'Jane Smith',
            'category' => 'Manajemen Proses Bisnis',
            'condition' => 'Seperti Baru',
            'sell_price' => 50000,
            'rent_price' => 12000,
            'image_url' => 'books/manajemen_proses_bisnis.png',
        ]);

        Book::create([
            'title' => 'Fundamental MPB',
            'author' => 'Marlon Dumas',
            'category' => 'Manajemen Proses Bisnis',
            'condition' => 'Baru',
            'sell_price' => 50000,
            'rent_price' => 15000,
            'image_url' => 'books/fundamental_mpb.png',
        ]);

        Book::create([
            'title' => 'Sistem Enterprise',
            'author' => 'Mahendrawati ER,Ph.D.',
            'category' => 'Pemrograman',
            'condition' => 'Baik',
            'sell_price' => 60000,
            'rent_price' => 18000,
            'image_url' => 'books/sistem_enterprise.png',
        ]);
    }
}
