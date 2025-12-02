<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\CartController;

Route::get('/', [HomeController::class, 'showHomePage'])->name('home'); // When user hits '/', call homepage
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
Route::get('/sellers/{id}', [SellerController::class, 'show'])->name('sellers.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
