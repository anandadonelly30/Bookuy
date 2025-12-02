<?php

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
    public function showCheckoutPage()
    {
        $user = Auth::user();
        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kamu kosong!');
        }

        $defaultAddress = $user->defaultAddress ?? $user->addresses()->first();

        $subTotal = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });
        
        $adminFee = 1000;
        $shippingFee = 5000;
        $total = $subTotal + $adminFee + $shippingFee;

        return view('checkout.index', compact('cartItems', 'defaultAddress', 'subTotal', 'adminFee', 'shippingFee', 'total'));
    }

    public function processOrderCheckout(Request $request)
    {
        $user = Auth::user();
        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kamu kosong!');
        }
        
        $request->validate([
            'address_id' => 'required|exists:addresses,id,user_id,' . $user->id,
            'payment_method' => 'required|string',
        ]);

        $subTotal = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });
        $adminFee = 1000; 
        $shippingFee = 5000; 
        $total = $subTotal + $adminFee + $shippingFee;

        $order = DB::transaction(function () use ($user, $cartItems, $request, $subTotal, $adminFee, $shippingFee, $total) {
            $order = Order::create([
                'user_id' => $user->id,
                'address_id' => $request->address_id,
                'sub_total' => $subTotal,
                'admin_fee' => $adminFee,
                'shipping_fee' => $shippingFee,
                'total_amount' => $total,
                'status' => 'ONGOING',
                'payment_method' => $request->payment_method,
                'payment_status' => 'PENDING',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price_per_unit' => $item->product->price,
                    'product_name' => $item->product->name,
                ]);
            }

            CartItem::where('user_id', $user->id)->delete();
            
            $user->notifications()->create([
                'title' => 'Order Diterima!',
                'description' => 'Order #' . $order->id . ' telah berhasil dibuat dan sedang diproses.',
                'icon' => 'wallet',
            ]);

            return $order;
        });

        return redirect()->route('checkout.success', $order);
    }

    public function showOrderSuccessPage(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('checkout.success', compact('order'));
    }
}
