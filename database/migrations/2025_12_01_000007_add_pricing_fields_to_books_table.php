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
            if (!Schema::hasColumn('books', 'price_buy')) {
                $table->integer('price_buy')->default(0)->after('author');
            }
            if (!Schema::hasColumn('books', 'price_rent')) {
                $table->integer('price_rent')->default(0)->after('price_buy');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (Schema::hasColumn('books', 'price_rent')) {
                $table->dropColumn('price_rent');
            }
            if (Schema::hasColumn('books', 'price_buy')) {
                $table->dropColumn('price_buy');
            }
        });
    }
};
