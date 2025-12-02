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
            if (!Schema::hasColumn('books', 'short_description')) {
                $table->string('short_description')->nullable()->after('cover_image_url');
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (Schema::hasColumn('books', 'rating_count')) {
                $table->dropColumn('rating_count');
            }
            if (Schema::hasColumn('books', 'rating_average')) {
                $table->dropColumn('rating_average');
            }
            if (Schema::hasColumn('books', 'pages')) {
                $table->dropColumn('pages');
            }
            if (Schema::hasColumn('books', 'category')) {
                $table->dropColumn('category');
            }
            if (Schema::hasColumn('books', 'condition')) {
                $table->dropColumn('condition');
            }
            if (Schema::hasColumn('books', 'address')) {
                $table->dropColumn('address');
            }
            if (Schema::hasColumn('books', 'full_description')) {
                $table->dropColumn('full_description');
            }
            if (Schema::hasColumn('books', 'short_description')) {
                $table->dropColumn('short_description');
            }
        });
    }
};
