<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Update notifications table to match class diagram specification
     * Keeps backward compatibility via model accessors
     */
    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Rename 'message' to 'description' to match class diagram
            $table->renameColumn('message', 'description');
            
            // Keep icon field for now (useful for UI, can be added to diagram)
            // $table->dropColumn('icon'); // SKIP - keeping for backward compatibility
            
            // Drop 'read_at' timestamp
            $table->dropColumn('read_at');
        });
        
        // Add 'is_read' boolean field separately (can't rename type)
        Schema::table('notifications', function (Blueprint $table) {
            $table->boolean('is_read')->default(false)->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Reverse: remove is_read boolean
            $table->dropColumn('is_read');
        });
        
        Schema::table('notifications', function (Blueprint $table) {
            // Reverse: rename back to 'message'
            $table->renameColumn('description', 'message');
            
            // Reverse: restore icon field
            $table->string('icon')->nullable();
            
            // Reverse: restore read_at timestamp
            $table->timestamp('read_at')->nullable();
        });
    }
};
