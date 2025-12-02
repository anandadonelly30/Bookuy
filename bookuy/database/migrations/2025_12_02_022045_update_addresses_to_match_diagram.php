<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Update addresses table to match class diagram specification
     * CRITICAL: Adds missing receiverName field and splits address structure
     */
    public function up(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            // Rename 'nickname' to 'label_address' to match class diagram
            $table->renameColumn('nickname', 'label_address');
            
            // Add missing 'receiver_name' field (CRITICAL)
            $table->string('receiver_name')->after('label_address');
            
            // Add separate address fields to match class diagram
            $table->string('street')->nullable()->after('department');
            $table->string('city')->nullable()->after('street');
            $table->string('province')->nullable()->after('city');
            $table->string('postal_code')->nullable()->after('province');
            
            // Keep full_address for backward compatibility (will be deprecated)
            // Keep latitude/longitude for map feature (enhancement)
            // Keep is_default for UX (enhancement)
            // Keep department for specific use case (enhancement)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            // Reverse: rename back to 'nickname'
            $table->renameColumn('label_address', 'nickname');
            
            // Reverse: drop added fields
            $table->dropColumn(['receiver_name', 'street', 'city', 'province', 'postal_code']);
        });
    }
};
