<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Product;
use App\Models\Notification;
use App\Models\CartItem;

class MySqlSmokeTest extends TestCase
{
    use RefreshDatabase; // Uses sqlite in-memory per phpunit.xml

    /** @test */
    public function dashboard_and_notifications_load_with_seeded_data()
    {
        $user = User::factory()->create();

        // Seed minimal products
        $p1 = Product::create([
            'name' => 'Algoritma Dasar',
            'description' => 'Buku algoritma untuk pemula',
            'price' => 75000,
            'stock' => 5,
            'type' => 'sell',
        ]);
        $p2 = Product::create([
            'name' => 'Pemrograman Web',
            'description' => 'Dasar-dasar PWEB',
            'price' => 64000,
            'stock' => 3,
            'type' => 'sell',
        ]);

        // Seed notifications
        Notification::create([
            'user_id' => $user->id,
            'title' => '50% Special Discount!',
            'message' => 'Special promotion only today',
            'icon' => 'discount',
        ]);

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertStatus(200)
            ->assertSee('Algoritma Dasar')
            ->assertSee('Pemrograman Web');

        $this->actingAs($user)
            ->get('/notifications')
            ->assertStatus(200)
            ->assertSee('50% Special Discount!');
    }

    /** @test */
    public function can_add_product_to_cart_via_json_endpoint()
    {
        $user = User::factory()->create();
        $product = Product::create([
            'name' => 'Matematika Lanjut',
            'price' => 82000,
            'stock' => 10,
            'type' => 'sell',
        ]);

        $response = $this->actingAs($user)
            ->postJson('/cart/add/'.$product->id);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('cart_items', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);
    }
}
