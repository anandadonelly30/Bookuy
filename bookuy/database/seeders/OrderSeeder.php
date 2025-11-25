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
                'user_id'      => $user->id,
                'nickname'     => 'Kampus',
                'department'   => 'TI',
                'full_address' => 'Jl. Contoh No. 123, Bandung',
                'phone_number' => '081234567890',
                'latitude'     => -6.2000000,
                'longitude'    => 106.8166660,
                'is_default'   => true,
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
                'total'          => $total,
                'status'         => 'delivered',
                'payment_method' => 'transfer',
            ]);

            foreach ($selected as $p) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $p->id,
                    'quantity'     => 1,
                    'price'        => $p->price,
                    'product_name' => $p->name,
                ]);
            }

            // Sample notification for seeded order
            $user->notifications()->create([
                'title'   => 'Order #' . $order->id . ' delivered',
                'message' => 'Pesanan kamu telah sampai. Terima kasih!',
                'icon'    => 'truck',
            ]);
        }
    }
}
