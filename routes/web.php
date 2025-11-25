<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';





use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SessionController;

Route::middleware('auth')->group(function () {

    // View Order History -> getHistory
    Route::get('/purchase-history', [OrderController::class, 'getHistory'])->name('purchase.history');

    // View Sales History -> getHistory
    Route::get('/sales-history', [OrderController::class, 'getSalesHistory'])->name('sales.history');

    // Track Order -> getOrderStatus
    Route::get('/track-order/{id}', [OrderController::class, 'getOrderStatus'])->name('order.track');

    // Leave Review -> saveReview
    Route::post('/reviews', [ReviewController::class, 'saveReview'])->name('reviews.store');

    // LogOut -> processLogout
    Route::post('/logout', [SessionController::class, 'processLogout'])->name('logout');

    // Profile Menu (Home Base)
    Route::get('/profile-menu', function () {
        return view('profile.menu');
    })->name('profile.menu');
});
