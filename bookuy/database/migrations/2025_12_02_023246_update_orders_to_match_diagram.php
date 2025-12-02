<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Update orders table to match class diagram specification
     */
    public function up(): void
    {
        // Add total_amount field (consolidation of all fees)
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('total_amount', 10, 2)->nullable()->after('total');
        });
        
        $driver = Schema::getConnection()->getDriverName();
        
        // Copy total to total_amount for existing records
        DB::statement("UPDATE orders SET total_amount = total");
        
        // Make old 'total' field nullable for backward compatibility
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('total', 10, 2)->nullable()->change();
        });
        
        // Update status values and add payment_status
        if ($driver === 'sqlite') {
            // SQLite: Update existing data
            DB::statement("UPDATE orders SET status = 'ONGOING' WHERE status IN ('pending', 'packing', 'shipping')");
            DB::statement("UPDATE orders SET status = 'COMPLETED' WHERE status IN ('delivered')");
            
            // Add payment_status column
            Schema::table('orders', function (Blueprint $table) {
                $table->string('payment_status')->default('PENDING')->after('status');
            });
            
        } else {
            // MySQL: Update status enum
            // Step 1: Add temporary column
            DB::statement("ALTER TABLE orders ADD COLUMN status_new ENUM('ONGOING', 'COMPLETED') DEFAULT 'ONGOING' AFTER status");
            
            // Step 2: Convert data
            DB::statement("UPDATE orders SET status_new = CASE 
                WHEN status IN ('pending', 'packing', 'shipping') THEN 'ONGOING' 
                WHEN status IN ('delivered') THEN 'COMPLETED' 
                ELSE 'ONGOING' END");
            
            // Step 3: Drop old, rename new
            DB::statement("ALTER TABLE orders DROP COLUMN status");
            DB::statement("ALTER TABLE orders CHANGE COLUMN status_new status ENUM('ONGOING', 'COMPLETED') DEFAULT 'ONGOING'");
            
            // Add payment_status enum
            DB::statement("ALTER TABLE orders ADD COLUMN payment_status ENUM('PENDING', 'PAID', 'FAILED', 'REFUNDED') DEFAULT 'PENDING' AFTER status");
        }
        
        // Keep sub_total, shipping_fee, admin_fee for detailed breakdown (enhancement)
        // These provide better transparency than single total_amount
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['total_amount', 'payment_status']);
        });
        
        $driver = Schema::getConnection()->getDriverName();
        
        if ($driver !== 'sqlite') {
            // Restore original status enum (MySQL only)
            DB::statement("ALTER TABLE orders MODIFY COLUMN status VARCHAR(255) DEFAULT 'pending'");
        }
    }
};
