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
            if (Schema::hasColumn('books', 'popularity_score')) {
                $table->dropColumn('popularity_score');
            }
            if (Schema::hasColumn('books', 'is_recommended')) {
                $table->dropColumn('is_recommended');
            }
        });
    }
};
