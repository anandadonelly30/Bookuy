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
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->nullable()->after('email');
            $table->integer('semester')->nullable()->after('gender');
            $table->text('description')->nullable()->after('semester');
            $table->string('phone_number')->nullable()->after('description');
            $table->string('profile_picture')->nullable()->after('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['gender', 'semester', 'description', 'phone_number', 'profile_picture']);
        });
    }
};
