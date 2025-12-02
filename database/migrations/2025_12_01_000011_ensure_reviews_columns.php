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
        if (!Schema::hasTable('reviews')) {
            Schema::create('reviews', function (Blueprint $table) {
                $table->id();
                $table->foreignId('book_id')->constrained()->onDelete('cascade');
                $table->string('reviewer_name')->nullable();
                $table->unsignedTinyInteger('stars')->default(0);
                $table->text('comment')->nullable();
                $table->timestamps();
            });
            return;
        }

        Schema::table('reviews', function (Blueprint $table) {
            if (!Schema::hasColumn('reviews', 'book_id')) {
                $table->foreignId('book_id')->nullable()->constrained()->onDelete('cascade')->after('id');
            }
            if (!Schema::hasColumn('reviews', 'reviewer_name')) {
                $table->string('reviewer_name')->nullable()->after('book_id');
            }
            if (!Schema::hasColumn('reviews', 'stars')) {
                $table->unsignedTinyInteger('stars')->default(0)->after('reviewer_name');
            }
            if (!Schema::hasColumn('reviews', 'comment')) {
                $table->text('comment')->nullable()->after('stars');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            if (Schema::hasColumn('reviews', 'comment')) {
                $table->dropColumn('comment');
            }
            if (Schema::hasColumn('reviews', 'stars')) {
                $table->dropColumn('stars');
            }
            if (Schema::hasColumn('reviews', 'reviewer_name')) {
                $table->dropColumn('reviewer_name');
            }
            if (Schema::hasColumn('reviews', 'book_id')) {
                $table->dropForeign(['book_id']);
                $table->dropColumn('book_id');
            }
        });
    }
};
