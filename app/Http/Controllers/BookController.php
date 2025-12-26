<?php

namespace App\Http\Controllers;

use App\Services\BookuyUseCaseService;
use Illuminate\View\View;

class BookController extends Controller
{
    private BookuyUseCaseService $useCaseService;

    public function __construct(BookuyUseCaseService $useCaseService)
    {
        $this->useCaseService = $useCaseService;
    }

    /**
     * ViewBookDetails - CDR Use Case
     * Displays book details including title, author, price, condition, description,
     * seller summary, and rating summary. Reviews are integrated on this page.
     */
    public function ViewBookDetails(int $id): View
    {
        try {
            $data = $this->useCaseService->ViewBookDetails($id);
            return view('books.show', $data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Buku tidak ditemukan');
        }
    }

    // Legacy method for compatibility
    public function show(int $id): View
    {
        return $this->ViewBookDetails($id);
    }
}
