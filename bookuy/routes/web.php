<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'showHomepageWithProducts'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/account', [ProfileController::class, 'showAccountPage'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'showEditProfileForm'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'updateUserProfile'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'deleteUserAccount'])->name('profile.destroy');

    Route::get('/cart', [CartController::class, 'viewShoppingCart'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'addProductToCart'])->name('cart.add');
    Route::patch('/cart/update/{cartItem}', [CartController::class, 'updateCartItemQuantity'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'removeProductFromCart'])->name('cart.remove');

    Route::get('/addresses', [AddressController::class, 'viewUserAddresses'])->name('address.index');
    Route::get('/addresses/create', [AddressController::class, 'showCreateAddressForm'])->name('address.create');
    Route::post('/addresses', [AddressController::class, 'createNewAddress'])->name('address.store');
    Route::get('/addresses/{address}/edit', [AddressController::class, 'showEditAddressForm'])->name('address.edit');
    Route::patch('/addresses/{address}', [AddressController::class, 'updateExistingAddress'])->name('address.update');
    Route::delete('/addresses/{address}', [AddressController::class, 'deleteAddress'])->name('address.destroy');
    Route::patch('/addresses/{address}/set-default', [AddressController::class, 'markAddressAsDefault'])->name('address.setDefault');

    Route::get('/checkout', [CheckoutController::class, 'showCheckoutPage'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'processOrderCheckout'])->name('checkout.process');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'showOrderSuccessPage'])->name('checkout.success');

    Route::get('/notifications', [NotificationController::class, 'viewUserNotifications'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markNotificationAsRead'])->name('notifications.read');

});

require __DIR__.'/auth.php';