<?php
// FILE: database/migrations/2025_11_18_100001_create_products_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// FIX: Menggunakan NAMED CLASS
class CreateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('image_url')->nullable();
            $table->string('category')->default('book'); // book, stationery, etc
            $table->string('mata_kuliah')->nullable(); // SKPB, MPB, PWEB, SE, etc
            $table->string('location')->nullable(); // Jakarta, Bandung, Surabaya
            $table->string('author')->nullable();
            $table->integer('stock')->default(0);
            $table->enum('type', ['sell', 'rent'])->default('sell'); // untuk beli atau sewa
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};