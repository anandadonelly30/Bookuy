<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Display the homepage/dashboard with products, filters, and search
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Filter by mata kuliah (SKPB, MPB, PWEB, SE, etc)
        if ($request->filled('mata_kuliah')) {
            $query->where('mata_kuliah', $request->mata_kuliah);
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        // Filter by price range
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Sort by
        $sortBy = $request->get('sort_by', 'recommended');
        if ($sortBy === 'price_low') {
            $query->orderBy('price', 'asc');
        } elseif ($sortBy === 'price_high') {
            $query->orderBy('price', 'desc');
        } else {
            // Recommended: newest first
            $query->orderBy('created_at', 'desc');
        }

        // Get filtered products
        $products = $query->get();

        // Recommended books (latest 6)
        $recommendedBooks = Product::orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Popular books (just random for now, you can add view_count later)
        $popularBooks = Product::inRandomOrder()
            ->take(6)
            ->get();

        // Categories for filter
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