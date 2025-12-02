<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user
        User::factory()->create([
            'username' => 'Test User',  // Updated to match class diagram
            'email' => 'test@example.com',
        ]);

        // Seed books (products), cart items, notifications, orders
        $this->call([
            BookSeeder::class,  // Renamed from ProductSeeder to match class diagram
            CartSeeder::class,
            NotificationSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
