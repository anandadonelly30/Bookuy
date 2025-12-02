<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\View\View;

class BookController extends Controller
{
    public function show(int $id): View
    {
        $book = Book::with(['categories', 'seller', 'reviews'])->findOrFail($id);

        return view('books.show', compact('book'));
    }
}
