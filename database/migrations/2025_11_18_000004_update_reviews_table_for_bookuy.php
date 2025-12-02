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
        Schema::table('reviews', function (Blueprint $table) {
            if (!Schema::hasColumn('reviews', 'reviewer_name')) {
                $table->string('reviewer_name')->nullable()->after('book_id');
            }
            if (!Schema::hasColumn('reviews', 'stars')) {
                $table->unsignedTinyInteger('stars')->default(0)->after('reviewer_name');
            }
            if (Schema::hasColumn('reviews', 'rating') && !Schema::hasColumn('reviews', 'stars')) {
                // If stars not created due to order, ensure it exists; handled above.
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            if (Schema::hasColumn('reviews', 'reviewer_name')) {
                $table->dropColumn('reviewer_name');
            }
            if (Schema::hasColumn('reviews', 'stars')) {
                $table->dropColumn('stars');
            }
        });
    }
};
