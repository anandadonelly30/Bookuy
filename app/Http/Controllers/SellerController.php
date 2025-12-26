<?php

namespace App\Http\Controllers;

use App\Services\BookuyUseCaseService;
use Illuminate\View\View;

class SellerController extends Controller
{
    private BookuyUseCaseService $useCaseService;

    public function __construct(BookuyUseCaseService $useCaseService)
    {
        $this->useCaseService = $useCaseService;
    }

    /**
     * ViewSellerProfile - CDR Use Case
     * Displays seller info (name, campus or location if present, average rating, number of listings).
     * Shows seller's listed books.
     */
    public function ViewSellerProfile(int $id): View
    {
        try {
            $data = $this->useCaseService->ViewSellerProfile($id);
            return view('sellers.show', $data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Penjual tidak ditemukan');
        }
    }

    // Legacy method for compatibility
    public function show(int $id): View
    {
        return $this->ViewSellerProfile($id);
    }
}
