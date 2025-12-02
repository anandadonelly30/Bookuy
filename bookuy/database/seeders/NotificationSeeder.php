<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure we have at least one user
        $user = User::first() ?? User::factory()->create([
            'username' => 'Demo User',  // Updated to match class diagram
            'email' => 'demo@example.com',
        ]);

        $samples = [
            [
                'title' => '50% Special Discount!',
                'description' => 'Special promotion only today',  // Updated field name
                'icon' => 'discount',
                'is_read' => false,  // Updated field name (boolean)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Top Up E-wallet Successfully!',
                'description' => 'You have top up e-wallet',  // Updated field name
                'icon' => 'wallet',
                'is_read' => false,  // Updated field name (boolean)
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'title' => 'New Service Available!',
                'description' => 'Now you can track order in real-time',  // Updated field name
                'icon' => 'service',
                'is_read' => false,  // Updated field name (boolean)
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'title' => 'Credit Card Connected!',
                'description' => 'Credit card has been linked',  // Updated field name
                'icon' => 'card',
                'is_read' => true,  // Updated field name (boolean)
                'created_at' => now()->setDate(2025,5,7),
                'updated_at' => now()->setDate(2025,5,7),
            ],
            [
                'title' => 'Account Setup Successfully!',
                'description' => 'Your account has been created',  // Updated field name
                'icon' => 'success',
                'is_read' => true,  // Updated field name (boolean)
                'created_at' => now()->setDate(2025,5,7),
                'updated_at' => now()->setDate(2025,5,7),
            ],
        ];

        foreach ($samples as $sample) {
            Notification::create(array_merge($sample, ['user_id' => $user->id]));
        }
    }
}
