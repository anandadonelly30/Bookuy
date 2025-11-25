<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SellerItem;
use App\Models\User;
use App\Models\Book;

class SellerItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada user dan buku untuk dihubungkan
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create(); // Buat user jika belum ada
        }

        $books = Book::all();

        if ($books->isEmpty()) {
            // Jika tidak ada buku, jalankan BookSeeder terlebih dahulu
            $this->call(BookSeeder::class);
            $books = Book::all();
        }

        SellerItem::create([
            'user_id' => $user->id,
            'book_id' => $books->firstWhere('title', 'Matematika Dasar')->id ?? 1,
            'status' => 'available',
        ]);

        SellerItem::create([
            'user_id' => $user->id,
            'book_id' => $books->firstWhere('title', 'Manajemen Proses Bisnis')->id ?? 2,
            'status' => 'available',
        ]);

        SellerItem::create([
            'user_id' => $user->id,
            'book_id' => $books->firstWhere('title', 'Fundamental MPB')->id ?? 3,
            'status' => 'available',
        ]);

        SellerItem::create([
            'user_id' => $user->id,
            'book_id' => $books->firstWhere('title', 'Sistem Enterprise')->id ?? 4,
            'status' => 'available',
        ]);
    }
}
