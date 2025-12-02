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
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('icon')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('book_category')) {
            Schema::create('book_category', function (Blueprint $table) {
                $table->unsignedBigInteger('book_id');
                $table->unsignedBigInteger('category_id');
                $table->primary(['book_id', 'category_id']);

                $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_category');
        Schema::dropIfExists('categories');
    }
};
