<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * LeaveReview (Halaman 35)
     * Message 3.1: saveReview(orderItemID, dataUlasan)
     */
    public function saveReview(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string'
        ]);

        // 2. Simpan ke Database (Message 3.1.1: create)
        Review::create([
            'user_id' => Auth::id(),
            'book_id' => $validated['book_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment']
        ]);

        // 3. Kembali ke Halaman Sebelumnya (Message 3.1.2: showSuccess)
        return back()->with('success', 'Ulasan berhasil disimpan!');
    }
}
