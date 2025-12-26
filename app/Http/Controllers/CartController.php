<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Services\BookuyUseCaseService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    private BookuyUseCaseService $useCaseService;

    public function __construct(BookuyUseCaseService $useCaseService)
    {
        $this->useCaseService = $useCaseService;
    }

    /**
     * Display the cart page with items from database.
     */
    public function index(): View
    {
        $cart = Cart::getOrCreateCart();
        $cartItems = $cart->items()->with('book')->get();

        // Separate buy and rent items
        $buyItems = $cartItems->where('type', 'buy')->values();
        $rentItems = $cartItems->where('type', 'rent')->values();

        $buySubtotal = $buyItems->sum(fn($item) => $item->price * $item->quantity);
        $rentSubtotal = $rentItems->sum(fn($item) => $item->price * $item->quantity);
        $total = $buySubtotal + $rentSubtotal;

        return view('cart.index', [
            'cart' => [
                'buy' => $buyItems,
                'rent' => $rentItems,
            ],
            'buySubtotal' => $buySubtotal,
            'rentSubtotal' => $rentSubtotal,
            'total' => $total,
        ]);
    }

    /**
     * AddToCart - CDR Use Case
     * Adds a book to the cart, incrementing quantity if already present.
     * POST /addToCart with itemId and type parameters.
     */
    public function AddToCart(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'book_id' => 'required|integer',
            'mode' => 'required|in:buy,rent',
            'title' => 'required|string',
            'cover' => 'nullable|string',
            'price' => 'nullable|integer',
        ]);

        $bookData = [
            'title' => $data['title'],
            'cover' => $data['cover'] ?? '',
        ];

        // Use CDR service method
        $result = $this->useCaseService->AddToCart(
            null, // userId - null for session-based cart
            (int) $data['book_id'],
            $data['mode'],
            $bookData
        );

        return redirect()
            ->route('ViewBookDetails', $data['book_id'])
            ->with('added_to_cart', true)
            ->with('cart_message', $result['message']);
    }

    /**
     * Legacy add method for compatibility.
     */
    public function add(Request $request): RedirectResponse
    {
        return $this->AddToCart($request);
    }

    /**
     * Remove an item from the cart.
     */
    public function remove(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'item_id' => 'required|integer',
        ]);

        $cart = Cart::getOrCreateCart();
        $cart->items()->where('id', $data['item_id'])->delete();

        return back()->with('cart_message', 'Item dihapus dari keranjang');
    }

    /**
     * Update quantity of an item in the cart.
     */
    public function updateQuantity(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'item_id' => 'required|integer',
            'action' => 'required|in:increment,decrement',
        ]);

        $cart = Cart::getOrCreateCart();
        $item = $cart->items()->where('id', $data['item_id'])->first();

        if ($item) {
            if ($data['action'] === 'increment') {
                $item->quantity += 1;
                $item->save();
            } elseif ($data['action'] === 'decrement' && $item->quantity > 1) {
                $item->quantity -= 1;
                $item->save();
            }
        }

        return back();
    }
}
