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
                $table->unsignedBigInteger('seller_id')->nullable()->after('id');
                $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (Schema::hasColumn('books', 'seller_id')) {
                $table->dropForeign(['seller_id']);
                $table->dropColumn('seller_id');
            }
        });
    }
};
