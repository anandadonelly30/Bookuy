<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Seller;
use Illuminate\View\View;

class SellerController extends Controller
{
    public function show(int $id): View
    {
        $seller = Seller::findOrFail($id);
        $sellerBooks = Book::where('seller_id', $seller->id)
            ->orderByDesc('popularity_score')
            ->get();

        return view('sellers.show', compact('seller', 'sellerBooks'));
    }
}
