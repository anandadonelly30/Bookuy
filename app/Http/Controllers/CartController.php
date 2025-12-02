<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = session('cart', ['rent' => [], 'buy' => []]);

        $buySubtotal = 0;
        foreach ($cart['buy'] as $item) {
            $buySubtotal += $item['price'] * $item['qty'];
        }

        $rentSubtotal = 0;
        foreach ($cart['rent'] as $item) {
            $rentSubtotal += $item['price'] * $item['months'];
        }

        $total = $buySubtotal + $rentSubtotal;

        return view('cart.index', compact('cart', 'buySubtotal', 'rentSubtotal', 'total'));
    }

    public function add(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'book_id' => 'required|integer',
            'mode' => 'required|in:buy,rent',
            'title' => 'required|string',
            'cover' => 'required|string',
            'price' => 'required|integer',
            'months' => 'nullable|integer|min:1',
            'qty' => 'nullable|integer|min:1',
        ]);

        $cart = session('cart', ['rent' => [], 'buy' => []]);

        if ($data['mode'] === 'rent') {
            $cart['rent'][] = [
                'book_id' => $data['book_id'],
                'title' => $data['title'],
                'cover' => $data['cover'],
                'price' => (int) $data['price'],
                'months' => max(1, (int) ($data['months'] ?? 1)),
            ];
        } else {
            $cart['buy'][] = [
                'book_id' => $data['book_id'],
                'title' => $data['title'],
                'cover' => $data['cover'],
                'price' => (int) $data['price'],
                'qty' => max(1, (int) ($data['qty'] ?? 1)),
            ];
        }

        session(['cart' => $cart]);

        return redirect()->route('books.show', $data['book_id'])->with('added_to_cart', true);
    }

    public function remove(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'mode' => 'required|in:buy,rent',
            'index' => 'required|integer',
        ]);

        $cart = session('cart', ['rent' => [], 'buy' => []]);

        if (isset($cart[$data['mode']][$data['index']])) {
            array_splice($cart[$data['mode']], $data['index'], 1);
            session(['cart' => $cart]);
        }

        return back();
    }
}
