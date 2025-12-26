<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes - CDR Use Case Aligned
|--------------------------------------------------------------------------
|
| Routes are named according to CDR use case names:
| - ViewRecommended
| - ViewBookDetails
| - ViewSellerProfile
| - AddToCart
|
*/

// Redirect root to ViewRecommended
Route::get('/', fn() => redirect()->route('ViewRecommended'));

// CDR Use Case: ViewRecommended
// Entry screen that shows a list of recommended books.
Route::get('/recommended', [HomeController::class, 'ViewRecommended'])->name('ViewRecommended');

// Legacy route for compatibility
Route::get('/home', [HomeController::class, 'ViewRecommended'])->name('home');

// CDR Use Case: ViewBookDetails
// Displays book details including reviews section (integrated).
Route::get('/books/{id}', [BookController::class, 'ViewBookDetails'])->name('ViewBookDetails');

// Legacy route alias
Route::get('/books/{id}/details', [BookController::class, 'ViewBookDetails'])->name('books.show');

// CDR Use Case: ViewSellerProfile
// Displays seller info and their listed books.
Route::get('/sellers/{id}', [SellerController::class, 'ViewSellerProfile'])->name('ViewSellerProfile');

// Legacy route alias
Route::get('/sellers/{id}/profile', [SellerController::class, 'ViewSellerProfile'])->name('sellers.show');

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// CDR Use Case: AddToCart
// POST /addToCart with itemId and type parameters.
Route::post('/addToCart', [CartController::class, 'AddToCart'])->name('AddToCart');

// Legacy route alias
Route::post('/cart/add', [CartController::class, 'AddToCart'])->name('cart.add');

// Cart management
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
