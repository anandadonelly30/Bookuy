<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CartItem;
use App\Models\Product;
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

        // Get some products
        $matematika = Product::where('name', 'Matematika I')->where('type', 'sell')->first();
        $mpb = Product::where('name', 'MPB Fundamental')->where('type', 'sell')->first();
        $pweb = Product::where('name', 'Pemrograman Web')->where('type', 'sell')->first();
        
        // Rent products
        $matematikaRent = Product::where('name', 'Matematika I')->where('type', 'rent')->first();
        $mpbRent = Product::where('name', 'MPB Fundamental MPB')->where('type', 'rent')->first();

        // Add to cart - Buy items
        if ($matematika) {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $matematika->id,
                'quantity' => 2,
            ]);
        }

        if ($mpb) {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $mpb->id,
                'quantity' => 1,
            ]);
        }

        if ($pweb) {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $pweb->id,
                'quantity' => 1,
            ]);
        }

        // Add to cart - Rent items
        if ($matematikaRent) {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $matematikaRent->id,
                'quantity' => 1,
            ]);
        }

        if ($mpbRent) {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $mpbRent->id,
                'quantity' => 2,
            ]);
        }
    }
}
