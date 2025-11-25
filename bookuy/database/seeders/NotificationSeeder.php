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
            'name' => 'Demo User',
            'email' => 'demo@example.com',
        ]);

        $samples = [
            [
                'title' => '50% Special Discount!',
                'message' => 'Special promotion only today',
                'icon' => 'discount',
                'read_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Top Up E-wallet Successfully!',
                'message' => 'You have top up e-wallet',
                'icon' => 'wallet',
                'read_at' => null,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'title' => 'New Service Available!',
                'message' => 'Now you can track order in real-time',
                'icon' => 'service',
                'read_at' => null,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'title' => 'Credit Card Connected!',
                'message' => 'Credit card has been linked',
                'icon' => 'card',
                'read_at' => now()->subMonths(6),
                'created_at' => now()->setDate(2025,5,7),
                'updated_at' => now()->setDate(2025,5,7),
            ],
            [
                'title' => 'Account Setup Successfully!',
                'message' => 'Your account has been created',
                'icon' => 'success',
                'read_at' => now()->subMonths(6),
                'created_at' => now()->setDate(2025,5,7),
                'updated_at' => now()->setDate(2025,5,7),
            ],
        ];

        foreach ($samples as $sample) {
            Notification::create(array_merge($sample, ['user_id' => $user->id]));
        }
    }
}
