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
        if (!Schema::hasTable('sellers')) {
            Schema::create('sellers', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('role')->nullable();
                $table->string('avatar')->nullable();
                $table->text('about')->nullable();
                $table->timestamps();
            });
            return;
        }

        Schema::table('sellers', function (Blueprint $table) {
            if (!Schema::hasColumn('sellers', 'name')) {
                $table->string('name')->after('id');
            }
            if (!Schema::hasColumn('sellers', 'role')) {
                $table->string('role')->nullable()->after('name');
            }
            if (!Schema::hasColumn('sellers', 'avatar')) {
                $table->string('avatar')->nullable()->after('role');
            }
            if (!Schema::hasColumn('sellers', 'about')) {
                $table->text('about')->nullable()->after('avatar');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Do not drop sellers to avoid data loss; only drop added columns if present.
        Schema::table('sellers', function (Blueprint $table) {
            if (Schema::hasColumn('sellers', 'about')) {
                $table->dropColumn('about');
            }
            if (Schema::hasColumn('sellers', 'avatar')) {
                $table->dropColumn('avatar');
            }
            if (Schema::hasColumn('sellers', 'role')) {
                $table->dropColumn('role');
            }
            if (Schema::hasColumn('sellers', 'name')) {
                $table->dropColumn('name');
            }
        });
    }
};
