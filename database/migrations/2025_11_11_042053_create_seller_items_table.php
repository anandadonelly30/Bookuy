<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seller_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Seller
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->string('condition'); // e.g., 'new', 'used', 'good', 'fair'
            $table->decimal('price', 8, 2);
            $table->integer('stock');
            $table->string('status')->default('available'); // e.g., 'available', 'sold', 'rented'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_items');
    }
};
