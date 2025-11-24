<?php

use App\Http\Controllers\Admin\AddressController as AdminAddressController;
use App\Http\Controllers\Admin\CartController as AdminCartController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AddressController as UserAddressController;
use App\Http\Controllers\User\CartController as UserCartController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::get('/reset-password/{token}/{email}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // User Routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard.index');
        
        // Orders
        Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('orders.show');
        
        // Addresses
        Route::resource('addresses', UserAddressController::class)->except(['create', 'show', 'edit']);
        
        // Profile
        Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [UserProfileController::class, 'update'])->name('profile.update');
        
        // Cart
        Route::get('/cart', [UserCartController::class, 'index'])->name('cart.index');
        Route::post('/cart', [UserCartController::class, 'store'])->name('cart.store');
        Route::patch('/cart/{cart}', [UserCartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/{cart}', [UserCartController::class, 'destroy'])->name('cart.destroy');
        Route::delete('/cart-items/{cartItem}', [UserCartController::class, 'destroyItem'])->name('cart-items.destroy');
    });

    // Checkout & Payment (User facing but handled by CheckoutController)
    Route::get('/carts/{cart}/view-checkout', [CheckoutController::class, 'viewCheckout'])->name('carts.view-checkout');
    Route::post('/carts/{cart}/checkout', [CheckoutController::class, 'checkout'])->name('carts.checkout');
    Route::get('/orders/{order}/pay', [CheckoutController::class, 'showPaymentPage'])->name('orders.pay');
    Route::post('/orders/{order}/pay', [CheckoutController::class, 'processPayment'])->name('orders.process-payment');
    Route::get('payment/khalti/callback', [CheckoutController::class, 'khaltiCallback'])->name('payment.khalti.callback');
    Route::get('payment/{payment}/success', [CheckoutController::class, 'successUrl'])->name('payment.success');
    Route::get('payment/{payment}/failure', [CheckoutController::class, 'failureUrl'])->name('payment.failure');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'adminDashboard'])->name('dashboard.index');
    
    // Resources
    Route::resource('users', AdminUserController::class);
    Route::resource('users.addresses', AdminAddressController::class);
    Route::resource('products', AdminProductController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('orders', AdminOrderController::class);
    Route::resource('payments', AdminPaymentController::class);
    
    // Addresses (Admin view)
    Route::get('/addresses/all', [AdminAddressController::class, 'allIndex'])->name('addresses.all');
    
    // Carts (Admin view)
    Route::get('/carts', [AdminCartController::class, 'index'])->name('carts.index');
});
