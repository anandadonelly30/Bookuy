<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. User Utama (Farrel)
        // Di skenario ini, menjadi PEMBELI (untuk Purchase History)
        // dan juga PENJUAL (untuk Sales History)
        $me = User::create([
            'name' => 'Farrel Aditya',
            'email' => 'farrel@bookuy.com', // Login pakai ini
            'password' => Hash::make('password'),
        ]);

        // 2. User Lain (Mitra Transaksi)
        $seller = User::create([
            'name' => 'Toko Buku IT',
            'email' => 'seller@bookuy.com',
            'password' => Hash::make('password'),
        ]);

        $buyer = User::create([ // Orang yang membeli buku Anda
            'name' => 'Mahasiswa Maba',
            'email' => 'buyer@bookuy.com',
            'password' => Hash::make('password'),
        ]);


        // BAGIAN A: PURCHASE HISTORY (Anda Beli Buku Orang)
        // A.1 Data Ongoing (Purchase)
        $purchasesOngoing = [
            ['title' => 'Sistem Enterprise', 'price' => 200000, 'status' => 'In Transit', 'img' => 'images/books/sistem-enterprise.png'],
            ['title' => 'Fundamental MPB', 'price' => 199000, 'status' => 'Picked', 'img' => 'images/books/fundamental-mpb.png'],
            ['title' => 'Pemrograman Web Dasar', 'price' => 80000, 'status' => 'In Transit', 'img' => 'images/books/web-dasar.png'],
            ['title' => 'Matematika 1', 'price' => 40000, 'status' => 'Packing', 'img' => 'images/books/matematika.png'],
            ['title' => 'Fisika Dasar', 'price' => 95000, 'status' => 'Picked', 'img' => 'images/books/fisika-dasar.png']
        ];

        foreach ($purchasesOngoing as $item) {
            $book = Book::create([
                'user_id' => $seller->id, // Milik orang lain
                'title' => $item['title'],
                'author' => 'Penulis Buku',
                'price' => $item['price'],
                'condition' => 'Baru',
                'image' => $item['img'],
            ]);

            $order = Order::create([
                'user_id' => $me->id, // Anda yang beli
                'status' => $item['status'],
                'total_price' => $item['price'] + 5000,
                'tracking_number' => 'P-ON-' . rand(100, 999),
                'created_at' => now(),
            ]);

            OrderItem::create(['order_id' => $order->id, 'book_id' => $book->id, 'quantity' => 1, 'price' => $item['price']]);
        }

        // A.2 Data Completed (Purchase)
        $purchasesCompleted = [
            ['title' => 'Sistem Enterprise', 'price' => 200000, 'rating' => null, 'img' => 'images/books/sistem-enterprise.png'],
            ['title' => 'Fundamental MPB', 'price' => 199000, 'rating' => 4.5, 'img' => 'images/books/fundamental-mpb.png'],
            ['title' => 'Pemrograman Web Dasar', 'price' => 80000, 'rating' => null, 'img' => 'images/books/web-dasar.png'],
            ['title' => 'Matematika 1', 'price' => 40000, 'rating' => null, 'img' => 'images/books/matematika.png'],
            ['title' => 'Fisika Dasar', 'price' => 95000, 'rating' => 3.5, 'img' => 'images/books/fisika-dasar.png']
        ];

        foreach ($purchasesCompleted as $item) {
            $book = Book::create([
                'user_id' => $seller->id,
                'title' => $item['title'],
                'author' => 'Penulis Buku',
                'price' => $item['price'],
                'condition' => 'Baru',
                'image' => $item['img'],
            ]);

            $order = Order::create([
                'user_id' => $me->id,
                'status' => 'Completed',
                'total_price' => $item['price'] + 5000,
                'tracking_number' => 'P-CP-' . rand(100, 999),
                'created_at' => now()->subDays(1),
            ]);

            OrderItem::create(['order_id' => $order->id, 'book_id' => $book->id, 'quantity' => 1, 'price' => $item['price']]);

            if ($item['rating']) {
                Review::create(['user_id' => $me->id, 'book_id' => $book->id, 'rating' => $item['rating'], 'comment' => 'Good']);
            }
        }



        // BAGIAN B: SALES HISTORY (Orang Lain Beli Buku )

        // B.1 Sales Ongoing (Anda Jual, Status Masih Proses)
        $salesOngoing = [
            ['title' => 'Sistem Enterprise', 'price' => 200000, 'status' => 'In Transit', 'img' => 'images/books/sistem-enterprise.png'],
            ['title' => 'Fundamental MPB', 'price' => 199000, 'status' => 'Picked', 'img' => 'images/books/fundamental-mpb.png'],
            ['title' => 'Pemrograman Web Dasar', 'price' => 80000, 'status' => 'In Transit', 'img' => 'images/books/web-dasar.png'],
            ['title' => 'Matematika 1', 'price' => 40000, 'status' => 'Packing', 'img' => 'images/books/matematika.png'],
            ['title' => 'Fisika Dasar', 'price' => 95000, 'status' => 'Picked', 'img' => 'images/books/fisika-dasar.png']
        ];

        foreach ($salesOngoing as $item) {
            $book = Book::create([
                'user_id' => $me->id, // (Buku Milik ANDA)
                'title' => $item['title'],
                'author' => 'Farrel (Saya)',
                'price' => $item['price'],
                'condition' => 'Baru',
                'image' => $item['img'],
            ]);

            $order = Order::create([
                'user_id' => $buyer->id, // Orang lain yang beli
                'status' => $item['status'],
                'total_price' => $item['price'] + 5000,
                'tracking_number' => 'S-ON-' . rand(100, 999),
                'created_at' => now(),
            ]);

            OrderItem::create(['order_id' => $order->id, 'book_id' => $book->id, 'quantity' => 1, 'price' => $item['price']]);
        }

        // B.2 Sales Completed (Anda Jual, Status Selesai)
        $salesCompleted = [
            ['title' => 'Sistem Enterprise', 'price' => 200000, 'rating' => null, 'img' => 'images/books/sistem-enterprise.png'],
            ['title' => 'Fundamental MPB', 'price' => 199000, 'rating' => 5.0, 'img' => 'images/books/fundamental-mpb.png'],
            ['title' => 'Pemrograman Web Dasar', 'price' => 80000, 'rating' => null, 'img' => 'images/books/web-dasar.png'],
            ['title' => 'Matematika 1', 'price' => 40000, 'rating' => null, 'img' => 'images/books/matematika.png'],
            ['title' => 'Fisika Dasar', 'price' => 95000, 'rating' => 4.0, 'img' => 'images/books/fisika-dasar.png']
        ];

        foreach ($salesCompleted as $item) {
            $book = Book::create([
                'user_id' => $me->id, // Buku Milik ANDA
                'title' => $item['title'],
                'author' => 'Farrel (Saya)',
                'price' => $item['price'],
                'condition' => 'Baru',
                'image' => $item['img'],
            ]);

            $order = Order::create([
                'user_id' => $buyer->id, // Orang lain yang beli
                'status' => 'Completed',
                'total_price' => $item['price'] + 5000,
                'tracking_number' => 'S-CP-' . rand(100, 999),
                'created_at' => now()->subDays(2),
            ]);

            OrderItem::create(['order_id' => $order->id, 'book_id' => $book->id, 'quantity' => 1, 'price' => $item['price']]);

            // Review dari pembeli ke buku Anda
            if ($item['rating']) {
                Review::create(['user_id' => $buyer->id, 'book_id' => $book->id, 'rating' => $item['rating'], 'comment' => 'Mantap gan']);
            }
        }
    }
}
