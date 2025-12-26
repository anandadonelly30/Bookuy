<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations - Add session_id and book_id for guest cart support.
     */
    public function up(): void
    {
        // Add session_id to carts for guest users
        Schema::table('carts', function (Blueprint $table) {
            if (!Schema::hasColumn('carts', 'session_id')) {
                $table->string('session_id')->nullable()->after('user_id');
            }
        });

        // Make user_id nullable for guest carts
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->change();
        });

        // Add book_id and type to cart_items
        Schema::table('cart_items', function (Blueprint $table) {
            if (!Schema::hasColumn('cart_items', 'book_id')) {
                $table->foreignId('book_id')->nullable()->after('cart_id');
            }
            if (!Schema::hasColumn('cart_items', 'type')) {
                $table->string('type')->default('buy')->after('book_id'); // 'buy' or 'rent'
            }
            if (!Schema::hasColumn('cart_items', 'price')) {
                $table->integer('price')->default(0)->after('type');
            }
        });

        // Make seller_item_id nullable
        Schema::table('cart_items', function (Blueprint $table) {
            $table->foreignId('seller_item_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            if (Schema::hasColumn('carts', 'session_id')) {
                $table->dropColumn('session_id');
            }
        });

        Schema::table('cart_items', function (Blueprint $table) {
            if (Schema::hasColumn('cart_items', 'book_id')) {
                $table->dropColumn('book_id');
            }
            if (Schema::hasColumn('cart_items', 'type')) {
                $table->dropColumn('type');
            }
            if (Schema::hasColumn('cart_items', 'price')) {
                $table->dropColumn('price');
            }
        });
    }
};
