<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Update users table to match class diagram specification
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Rename 'name' to 'username' to match class diagram
            $table->renameColumn('name', 'username');
            
            // Rename 'phone_number' to 'no_telp' to match class diagram
            $table->renameColumn('phone_number', 'no_telp');
            
            // Keep extra fields (gender, semester, description, profile_picture)
            // These are enhancements that improve UX
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverse: rename back to original names
            $table->renameColumn('username', 'name');
            $table->renameColumn('no_telp', 'phone_number');
        });
    }
};
