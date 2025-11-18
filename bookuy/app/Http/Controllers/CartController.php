<?php
// FILE: app/Http/Controllers/CartController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\CartItem;

class CartController extends Controller
{
    // == USE CASE: ViewCart ==
    public function index(Request $request)
    {
        $userId = Auth::id();
        $activeType = $request->input('type', 'sell');
        
        // Validate type
        if (!in_array($activeType, ['sell', 'rent'])) {
            $activeType = 'sell';
        }

        // Get cart items filtered by type
        $cartItems = CartItem::with('product')
            ->where('user_id', $userId)
            ->where('type', $activeType)
            ->orderByDesc('created_at')
            ->get();

        // Get counts for tabs
        $sellCount = CartItem::where('user_id', $userId)->where('type', 'sell')->count();
        $rentCount = CartItem::where('user_id', $userId)->where('type', 'rent')->count();
            
        // Logika untuk menghitung subtotal, dll.
        $subTotal = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });
        
        // Admin fee dan shipping fee
        $adminFee = $subTotal > 0 ? 1000 : 0;
        $shippingFee = $subTotal > 0 ? ($activeType === 'rent' ? 9000 : 5000) : 0;
        $total = $subTotal + $adminFee + $shippingFee;

        return view('cart.index', compact('cartItems', 'subTotal', 'adminFee', 'shippingFee', 'total', 'activeType', 'sellCount', 'rentCount'));
    }

    public function add(Request $request, Product $product)
    {
        // Check if product has stock
        if ($product->stock <= 0) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Product out of stock'], 400);
            }
            return redirect()->back()->with('error', 'Product out of stock');
        }

        // Check if already in cart
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            if ($cartItem->quantity < $product->stock) {
                $cartItem->increment('quantity');
            } else {
                if ($request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'Maximum stock reached'], 400);
                }
                return redirect()->back()->with('error', 'Maximum stock reached');
            }
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->input('quantity', 1),
                'type' => $product->type,
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart',
                'cart_count' => CartItem::where('user_id', Auth::id())->count()
            ]);
        }
        
        return redirect()->route('cart.index')->with('success', 'Product added to cart');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        // Pastikan item milik user
        if ($cartItem->user_id !== Auth::id()) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }
            abort(403);
        }
        
        $quantity = $request->input('quantity', 1);
        
        // Validate quantity
        if ($quantity < 1) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Quantity must be at least 1'], 400);
            }
            return redirect()->back()->with('error', 'Quantity must be at least 1');
        }
        
        if ($quantity > $cartItem->product->stock) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Quantity exceeds available stock'], 400);
            }
            return redirect()->back()->with('error', 'Quantity exceeds available stock');
        }
        
        // Update quantity
        $cartItem->update(['quantity' => $quantity]);
        
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully'
            ]);
        }
        
        return redirect()->route('cart.index')->with('success', 'Cart updated');
    }

    public function remove(CartItem $cartItem)
    {
        // Pastikan item milik user
        if ($cartItem->user_id !== Auth::id()) {
            if (request()->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }
            abort(403);
        }

        $cartItem->delete();
        
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart'
            ]);
        }
        
        return redirect()->route('cart.index')->with('success', 'Product removed from cart');
    }
}