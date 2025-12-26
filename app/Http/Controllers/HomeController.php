<?php

namespace App\Http\Controllers;

use App\Services\BookuyUseCaseService;
use Illuminate\View\View;

class HomeController extends Controller
{
    private BookuyUseCaseService $useCaseService;

    public function __construct(BookuyUseCaseService $useCaseService)
    {
        $this->useCaseService = $useCaseService;
    }

    /**
     * ViewRecommended - CDR Use Case
     * Entry screen that shows a list of recommended books.
     */
    public function ViewRecommended(): View
    {
        $data = $this->useCaseService->ViewRecommended();

        return view('home', $data);
    }

    // Legacy method redirect for compatibility
    public function showHomePage(): View
    {
        return $this->ViewRecommended();
    }
}
