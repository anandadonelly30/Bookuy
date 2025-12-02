<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CartItem;
use App\Models\Book;
use App\Models\User;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        // Get test user
        $user = User::where('email', 'test@example.com')->first();
        
        if (!$user) {
            return;
        }

        // Clear existing cart items for test user
        CartItem::where('user_id', $user->id)->delete();

        // Get some books (products)
        $matematika = Book::where('name', 'Matematika I')->where('type', 'sell')->first();
        $mpb = Book::where('name', 'MPB Fundamental')->where('type', 'sell')->first();
        $pweb = Book::where('name', 'Pemrograman Web')->where('type', 'sell')->first();
        
        // Rent books
        $matematikaRent = Book::where('name', 'Matematika I')->where('type', 'rent')->first();
        $mpbRent = Book::where('name', 'MPB Fundamental MPB')->where('type', 'rent')->first();

        // Add to cart - Buy items (using class diagram enum 'BUY')
        if ($matematika) {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $matematika->id,
                'quantity' => 2,
                'type' => 'BUY',  // Class diagram enum value
            ]);
        }

        if ($mpb) {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $mpb->id,
                'quantity' => 1,
                'type' => 'BUY',  // Class diagram enum value
            ]);
        }

        if ($pweb) {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $pweb->id,
                'quantity' => 1,
                'type' => 'BUY',  // Class diagram enum value
            ]);
        }

        // Add to cart - Rent items (using class diagram enum 'RENT')
        if ($matematikaRent) {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $matematikaRent->id,
                'quantity' => 1,
                'type' => 'RENT',  // Class diagram enum value
            ]);
        }

        if ($mpbRent) {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $mpbRent->id,
                'quantity' => 2,
                'type' => 'RENT',  // Class diagram enum value
            ]);
        }
    }
}
