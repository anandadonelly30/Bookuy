<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Update order_items table to match class diagram specification
     */
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Rename 'product_id' to 'book_id' to match class diagram
            $table->renameColumn('product_id', 'book_id');
            
            // Rename 'price' to 'price_per_unit' to match class diagram
            $table->renameColumn('price', 'price_per_unit');
            
            // Keep product_name for order history (enhancement)
            // This ensures we have product info even if product is deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Reverse: rename back to original names
            $table->renameColumn('book_id', 'product_id');
            $table->renameColumn('price_per_unit', 'price');
        });
    }
};
