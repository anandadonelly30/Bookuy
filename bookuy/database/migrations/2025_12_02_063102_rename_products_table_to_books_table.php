<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Rename products table to books to match class diagram.
     * Cart_items still uses product_id (will be kept for backward compatibility).
     * Order_items already uses book_id from previous migration.
     */
    public function up(): void
    {
        // 1. Drop existing foreign keys that reference products table
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign(['product_id']); // Drops cart_items_product_id_foreign
        });
        
        // 2. Rename table products -> books
        Schema::rename('products', 'books');
        
        // 3. Re-add foreign key in cart_items table (now referencing books)
        Schema::table('cart_items', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('books')->onDelete('cascade');
        });
        
        // 4. Add foreign key in order_items table
        // Order_items already uses book_id column (renamed in previous migration)
        // No existing foreign key to drop
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Drop foreign keys first
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });
        
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['book_id']);
        });
        
        // 2. Rename table back to products
        Schema::rename('books', 'products');
        
        // 3. Re-add foreign keys to products
        Schema::table('cart_items', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
        
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('book_id')->references('id')->on('products')->onDelete('cascade');
        });
    }
};
