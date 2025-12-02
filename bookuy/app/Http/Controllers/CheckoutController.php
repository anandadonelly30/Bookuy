<?php


// FILE: app/Http/Controllers/CheckoutController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Show the checkout page with order review.
     * 
     * USE CASE: Checkout (View)
     * Displays cart items, default address, and price breakdown
     * (subtotal, admin fee, shipping fee, total) for order review.
     */
    public function showCheckoutPage()
    {
        $user = Auth::user();
        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kamu kosong!');
        }

        // Ambil alamat default
        $defaultAddress = $user->defaultAddress ?? $user->addresses()->first();

        // Hitung total
        $subTotal = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });
        
        $adminFee = 1000; // Contoh
        $shippingFee = 5000; // Contoh
        $total = $subTotal + $adminFee + $shippingFee;

        return view('checkout.index', compact('cartItems', 'defaultAddress', 'subTotal', 'adminFee', 'shippingFee', 'total'));
    }

    /**
     * Process the order checkout and create order records.
     * 
     * USE CASE: Checkout (Process)
     * Validates payment info, creates Order and OrderItems in a transaction,
     * clears the shopping cart, creates notification, and redirects to success page.
     */
    public function processOrderCheckout(Request $request)
    {
        $user = Auth::user();
        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kamu kosong!');
        }
        
        // Validasi request (address_id, payment_method, etc)
        $request->validate([
            'address_id' => 'required|exists:addresses,id,user_id,' . $user->id,
            'payment_method' => 'required|string',
        ]);

        // Hitung total lagi (best practice, jangan percaya frontend)
        $subTotal = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });
        $adminFee = 1000; 
        $shippingFee = 5000; 
        $total = $subTotal + $adminFee + $shippingFee;

        // Gunakan DB Transaction
        $order = DB::transaction(function () use ($user, $cartItems, $request, $subTotal, $adminFee, $shippingFee, $total) {
            // 1. Buat Order (using class diagram field names)
            $order = Order::create([
                'user_id' => $user->id,
                'address_id' => $request->address_id,
                'sub_total' => $subTotal,
                'admin_fee' => $adminFee,
                'shipping_fee' => $shippingFee,
                'total_amount' => $total,  // Updated field name from class diagram
                'status' => 'ONGOING',     // Updated enum value from class diagram
                'payment_method' => $request->payment_method,
                'payment_status' => 'PENDING', // New field from class diagram
            ]);

            // 2. Pindahkan item dari keranjang ke order_items (using class diagram field names)
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $item->product_id,  // Updated field name from class diagram
                    'quantity' => $item->quantity,
                    'price_per_unit' => $item->product->price, // Updated field name from class diagram
                    'product_name' => $item->product->name, // Simpan nama saat ini
                ]);
            }

            // 3. Kosongkan keranjang
            CartItem::where('user_id', $user->id)->delete();
            
            // 4. Buat Notifikasi (using class diagram field names)
            $user->notifications()->create([
                'title' => 'Order Diterima!',
                'description' => 'Order #' . $order->id . ' telah berhasil dibuat dan sedang diproses.',  // Updated field name
                'icon' => 'wallet', // ganti icon sesuai
            ]);

            return $order;
        });

        // Redirect ke halaman sukses
        return redirect()->route('checkout.success', $order);
    }

    /**
     * Show the order success page after checkout.
     * 
     * USE CASE: Checkout (Success)
     * Displays order confirmation with order details, items, and address.
     * Validates that the order belongs to the authenticated user.
     */
    public function showOrderSuccessPage(Order $order)
    {
        // Ensure order belongs to authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('checkout.success', compact('order'));
    }
}
