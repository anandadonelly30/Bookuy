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
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'seller_id')) {
                $table->foreignId('seller_id')->nullable()->constrained('sellers')->nullOnDelete()->after('id');
            }
            if (!Schema::hasColumn('books', 'price_buy')) {
                $table->integer('price_buy')->default(0)->after('author');
            }
            if (!Schema::hasColumn('books', 'price_rent')) {
                $table->integer('price_rent')->default(0)->after('price_buy');
            }
            if (!Schema::hasColumn('books', 'cover')) {
                $table->string('cover')->nullable()->after('description');
            }
            if (!Schema::hasColumn('books', 'short_description')) {
                $table->string('short_description')->nullable()->after('cover');
            }
            if (!Schema::hasColumn('books', 'full_description')) {
                $table->text('full_description')->nullable()->after('short_description');
            }
            if (!Schema::hasColumn('books', 'address')) {
                $table->string('address')->nullable()->after('full_description');
            }
            if (!Schema::hasColumn('books', 'condition')) {
                $table->string('condition')->nullable()->after('address');
            }
            if (!Schema::hasColumn('books', 'category')) {
                $table->string('category')->nullable()->after('condition');
            }
            if (!Schema::hasColumn('books', 'pages')) {
                $table->integer('pages')->nullable()->after('category');
            }
            if (!Schema::hasColumn('books', 'rating_average')) {
                $table->decimal('rating_average', 3, 1)->default(0)->after('pages');
            }
            if (!Schema::hasColumn('books', 'rating_count')) {
                $table->integer('rating_count')->default(0)->after('rating_average');
            }
            if (!Schema::hasColumn('books', 'cover_image_url')) {
                $table->string('cover_image_url')->nullable()->after('rating_count');
            }
            if (!Schema::hasColumn('books', 'is_recommended')) {
                $table->boolean('is_recommended')->default(false)->after('cover_image_url');
            }
            if (!Schema::hasColumn('books', 'popularity_score')) {
                $table->integer('popularity_score')->default(0)->after('is_recommended');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['cover_image_url', 'is_recommended', 'popularity_score']);
        });
    }
};
