<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\View\View;

class HomeController extends Controller
{
    // When user hits '/', call homepage
    public function showHomePage(): View
    {
        // Controller loads recommended and popular books from DB
        $categories = Category::orderBy('name')->get();

        $recommendedBooks = Book::with('categories')
            ->inRandomOrder()
            ->take(10)
            ->get();

        $popularBooks = Book::orderByDesc('popularity_score')
            ->take(10)
            ->get();

        // Controller returns them to the view which displays them
        return view('home', compact('recommendedBooks', 'popularBooks', 'categories'));
    }
}
