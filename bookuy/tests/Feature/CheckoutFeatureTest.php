<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Book;
use App\Models\Address;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Notification;

class CheckoutFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_checkout_and_create_order_items_and_notification()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create address
        $address = Address::create([
            'user_id'      => $user->id,
            'nickname'     => 'Rumah',
            'department'   => 'TI',
            'full_address' => 'Jl. Testing 123',
            'phone_number' => '08123456789',
            'is_default'   => true,
        ]);

        // Create books (products) & cart items
        $products = [];
        for ($i = 0; $i < 3; $i++) {
            $p = Book::create([
                'name'        => 'Produk ' . $i,
                'description' => 'Deskripsi produk ' . $i,
                'price'       => 10000 + ($i * 5000),
                'author'      => 'Author ' . $i,
                'mata_kuliah' => 'PWEB',
                'location'    => 'Bandung',
            ]);
            $products[] = $p;
            CartItem::create([
                'user_id'    => $user->id,
                'product_id' => $p->id,
                'quantity'   => $i + 1,
            ]);
        }

        // Perform checkout
        $response = $this->post(route('checkout.process'), [
            'address_id'     => $address->id,
            'payment_method' => 'transfer',
        ]);

        // Should redirect to success page
        $order = Order::first();
        $response->assertRedirect(route('checkout.success', $order));

        // Assertions
        $this->assertNotNull($order, 'Order should be created');
        $this->assertEquals($user->id, $order->user_id);
        $this->assertEquals($address->id, $order->address_id);

        // Order items created
        $this->assertEquals(3, $order->items()->count(), 'Should have 3 order items');

        // Cart cleared
        $this->assertEquals(0, $user->cartItems()->count(), 'Cart should be emptied');

        // Notification created
        $this->assertEquals(1, $user->notifications()->count(), 'User should have a checkout notification');
        $notification = $user->notifications()->first();
        $this->assertStringContainsString('Order', $notification->title);

        // Total calculation: sum(price * quantity) + admin(1000) + shipping(5000)
        $expectedSubTotal = 0;
        foreach ($products as $idx => $p) {
            $expectedSubTotal += $p->price * ($idx + 1);
        }
        $this->assertEquals($expectedSubTotal, $order->sub_total, 'Sub total mismatch');
        $this->assertEquals($expectedSubTotal + 1000 + 5000, $order->total, 'Total mismatch');
    }
}
