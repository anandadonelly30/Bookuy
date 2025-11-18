<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama (dashboard/homepage)
Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');


// Grup route yang memerlukan login
Route::middleware('auth')->group(function () {
    
    // == USE CASE: Profile/Account ==
    Route::get('/account', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // == USE CASE: ViewCart ==
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');

    // == USE CASE: ManageAddress ==
    Route::get('/addresses', [AddressController::class, 'index'])->name('address.index');
    Route::get('/addresses/create', [AddressController::class, 'create'])->name('address.create');
    Route::post('/addresses', [AddressController::class, 'store'])->name('address.store');
    Route::get('/addresses/{address}/edit', [AddressController::class, 'edit'])->name('address.edit');
    Route::patch('/addresses/{address}', [AddressController::class, 'update'])->name('address.update');
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('address.destroy');
    Route::patch('/addresses/{address}/set-default', [AddressController::class, 'setDefault'])->name('address.setDefault');

    // == USE CASE: CheckOut ==
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

    // == USE CASE: ViewNotif ==
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index'); // <-- FIX: Tadinya Route.get, sekarang Route::get
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

});

// Ini adalah route bawaan Breeze untuk login, register, dll.
require __DIR__.'/auth.php';