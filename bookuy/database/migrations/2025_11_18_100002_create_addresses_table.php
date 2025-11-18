<?php

// FILE: database/migrations/2025_11_18_100002_create_addresses_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// FIX: Menggunakan NAMED CLASS
class CreateAddressesTable extends Migration
{
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nickname'); // e.g., "Home", "Office", "Apartment", "Parent's House", "Department"
            $table->string('department')->nullable(); // Department name untuk address type "Department"
            $table->text('full_address');
            $table->string('phone_number')->nullable();
            $table->decimal('latitude', 10, 7)->nullable(); // Untuk map pin
            $table->decimal('longitude', 10, 7)->nullable(); // Untuk map pin
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};