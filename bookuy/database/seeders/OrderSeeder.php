<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /**
     * Seed a couple of sample orders for the existing test user.
     */
    public function run(): void
    {
        $user = User::first();
        if (! $user) {
            return; // No user to attach orders to
        }

        // Ensure there is at least one address
        $address = $user->addresses()->first();
        if (! $address) {
            $address = Address::create([
                'user_id'        => $user->id,
                'label_address'  => 'Kampus',  // Updated field name
                'receiver_name'  => $user->username,  // Required field from class diagram
                'department'     => 'TI',
                'street'         => 'Jl. Contoh No. 123',  // New field from class diagram
                'city'           => 'Bandung',  // New field from class diagram
                'province'       => 'Jawa Barat',  // New field from class diagram
                'postal_code'    => '40132',  // New field from class diagram
                'full_address'   => 'Jl. Contoh No. 123, Bandung',  // Kept for backward compatibility
                'phone_number'   => '081234567890',
                'latitude'       => -6.2000000,
                'longitude'      => 106.8166660,
                'is_default'     => true,
            ]);
        }

        $products = Product::inRandomOrder()->take(4)->get();
        if ($products->isEmpty()) {
            return; // Need products seeded first
        }

        // Create 2 sample orders
        for ($i = 0; $i < 2; $i++) {
            $selected = $products->random(rand(1, min(3, $products->count())));
            $subTotal = 0;
            foreach ($selected as $p) {
                $subTotal += $p->price; // quantity = 1 for sample
            }
            $adminFee = 1000;
            $shippingFee = 5000;
            $total = $subTotal + $adminFee + $shippingFee;

            $order = Order::create([
                'user_id'        => $user->id,
                'address_id'     => $address->id,
                'sub_total'      => $subTotal,
                'admin_fee'      => $adminFee,
                'shipping_fee'   => $shippingFee,
                'total_amount'   => $total,  // Updated field name from class diagram
                'status'         => 'COMPLETED',  // Updated enum value from class diagram
                'payment_method' => 'transfer',
                'payment_status' => 'PAID',  // New field from class diagram
            ]);

            foreach ($selected as $p) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'book_id'      => $p->id,  // Updated field name from class diagram
                    'quantity'     => 1,
                    'price_per_unit' => $p->price,  // Updated field name from class diagram
                    'product_name' => $p->name,
                ]);
            }

            // Sample notification for seeded order
            $user->notifications()->create([
                'title'   => 'Order #' . $order->id . ' delivered',
                'description' => 'Pesanan kamu telah sampai. Terima kasih!',  // Updated field name
                'icon'    => 'truck',
            ]);
        }
    }
}
