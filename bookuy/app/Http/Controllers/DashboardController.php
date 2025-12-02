<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class DashboardController extends Controller
{
    public function showHomepageWithProducts(Request $request)
    {
        $query = Book::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        if ($request->filled('mata_kuliah')) {
            $query->where('mata_kuliah', $request->mata_kuliah);
        }

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        $sortBy = $request->get('sort_by', 'recommended');
        if ($sortBy === 'price_low') {
            $query->orderBy('price', 'asc');
        } elseif ($sortBy === 'price_high') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->get();

        $recommendedBooks = Book::orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $popularBooks = Book::inRandomOrder()
            ->take(6)
            ->get();

        $categories = ['Matematika', 'MPB', 'PWEB', 'SE', 'SKPB', 'Fisika', 'Kimia'];
        $locations = ['Jakarta', 'Bandung', 'Surabaya'];

        return view('dashboard', compact(
            'products',
            'recommendedBooks',
            'popularBooks',
            'categories',
            'locations'
        ));
    }
}