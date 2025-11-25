<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\SellerItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'condition' => 'required|string|max:255',
            'sell_price' => 'required|numeric|min:0',
            'rent_price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi untuk file gambar
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan gambar ke storage/app/public/books
            $imagePath = $request->file('image')->store('books', 'public');
        }

        // Buat buku baru
        $book = Book::create([
            'title' => $validatedData['title'],
            'author' => $validatedData['author'],
            'category' => $validatedData['category'],
            'condition' => $validatedData['condition'],
            'sell_price' => $validatedData['sell_price'],
            'rent_price' => $validatedData['rent_price'],
            'image_url' => $imagePath,
        ]);

        // Buat item penjual yang terkait dengan buku dan pengguna yang login
        SellerItem::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'status' => 'available',
        ]);

        return response()->json([
            'message' => 'Book successfully posted!',
            'book' => $book
        ], 201);
    }
}