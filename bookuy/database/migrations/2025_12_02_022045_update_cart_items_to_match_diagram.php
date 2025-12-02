<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Update cart_items table to match class diagram specification
     */
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        
        if ($driver === 'sqlite') {
            // SQLite doesn't support ENUM, use string with check constraint instead
            Schema::table('cart_items', function (Blueprint $table) {
                // For SQLite: Just update the existing data, column is already string type
            });
            
            // Update existing data
            DB::statement("UPDATE cart_items SET type = 'BUY' WHERE type = 'sell'");
            DB::statement("UPDATE cart_items SET type = 'RENT' WHERE type = 'rent'");
            
        } else {
            // MySQL/MariaDB: Use proper ENUM update
            // Step 1: Add temporary new column with correct enum values
            DB::statement("ALTER TABLE cart_items ADD COLUMN type_new ENUM('BUY', 'RENT') DEFAULT 'BUY' AFTER type");
            
            // Step 2: Copy and transform data from old column to new
            DB::statement("UPDATE cart_items SET type_new = CASE WHEN type = 'sell' THEN 'BUY' WHEN type = 'rent' THEN 'RENT' ELSE 'BUY' END");
            
            // Step 3: Drop old column
            DB::statement("ALTER TABLE cart_items DROP COLUMN type");
            
            // Step 4: Rename new column to 'type'
            DB::statement("ALTER TABLE cart_items CHANGE COLUMN type_new type ENUM('BUY', 'RENT') DEFAULT 'BUY'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse enum values
        DB::statement("UPDATE cart_items SET type = 'sell' WHERE type = 'BUY'");
        DB::statement("UPDATE cart_items SET type = 'rent' WHERE type = 'RENT'");
        
        // Restore original enum definition
        DB::statement("ALTER TABLE cart_items MODIFY COLUMN type ENUM('sell', 'rent') DEFAULT 'sell'");
    }
};
