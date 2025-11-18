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
    // == USE CASE: CheckOut (View) ==
    public function index()
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

    // == USE CASE: CheckOut (Process) ==
    public function process(Request $request)
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
            // 1. Buat Order
            $order = Order::create([
                'user_id' => $user->id,
                'address_id' => $request->address_id,
                'sub_total' => $subTotal,
                'admin_fee' => $adminFee,
                'shipping_fee' => $shippingFee,
                'total' => $total,
                'status' => 'pending', // atau 'packing' jika pembayaran langsung sukses
                'payment_method' => $request->payment_method,
            ]);

            // 2. Pindahkan item dari keranjang ke order_items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price, // Simpan harga saat ini
                    'product_name' => $item->product->name, // Simpan nama saat ini
                ]);
            }

            // 3. Kosongkan keranjang
            CartItem::where('user_id', $user->id)->delete();
            
            // 4. Buat Notifikasi (Contoh)
            $user->notifications()->create([
                'title' => 'Order Diterima!',
                'message' => 'Order #' . $order->id . ' telah berhasil dibuat dan sedang diproses.',
                'icon' => 'wallet', // ganti icon sesuai
            ]);

            return $order;
        });

        // Redirect ke halaman sukses
        return redirect()->route('checkout.success', $order);
    }

    public function success(Order $order)
    {
        // Pastikan order ini milik user yang login
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        
        // Sesuai screenshot "Checkout Success"
        return view('checkout.success', compact('order'));
    }
}
