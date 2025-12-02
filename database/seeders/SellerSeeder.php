<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    public function run(): void
    {
        $sellers = [
            [
                'name' => 'Missy Tiffany',
                'role' => 'Mahasiswi Semester 6',
                'avatar' => 'https://images.unsplash.com/photo-1544723795-3fb6469f5b39?auto=format&fit=crop&w=200&q=80',
                'about' => 'Welcome to Bookuy! I sell books for college students.',
            ],
            [
                'name' => 'Anita Rahmani',
                'role' => 'Product Manager',
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=200&q=80',
                'about' => 'Helping teams learn enterprise systems with curated books.',
            ],
            [
                'name' => 'Deni Wibowo',
                'role' => 'Software Engineer',
                'avatar' => 'https://images.unsplash.com/photo-1504593811423-6dd665756598?auto=format&fit=crop&w=200&q=80',
                'about' => 'Sharing programming books I use for community classes.',
            ],
        ];

        foreach ($sellers as $data) {
            Seller::factory()->create($data);
        }
    }
}
