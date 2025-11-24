<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController as ControllersProductController;
use App\Http\Controllers\UserController;
use App\Models\Cart;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/products', [ControllersProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ControllersProductController::class, 'show'])->name('products.show');

Route::resource('admin/products', ProductController::class)->names('admin.products');
Route::resource('/admin/categories', CategoryController::class)->names('admin.categories');
Route::resource('/admin/users', UserController::class)->names('admin.users')->only(['index', 'create', 'store']); // only admin can do this
Route::resource('/users', UserController::class)->names('users')->only(['show', 'edit', 'update', 'destroy']); // only user can do this

Route::resource('users.addresses', AddressController::class)->names('users.addresses');
Route::get('/admin/addresses/all', [AddressController::class, 'allIndex'])->name('admin.addresses.all');
Route::get('/admin/addresses', [AddressController::class, 'getAllIndex'])->name('admin.addresses.index');


Route::get('/carts/all', [CartController::class, 'allIndex'])->name('carts.index');
Route::resource('users.carts', CartController::class)
    ->only(['index', 'store', 'update', 'destroy', 'edit', 'show'])
    ->middleware('auth');
    
Route::middleware('auth')->group(function () {
    Route::delete('/cart-items/{cartItem}', [CartController::class, 'destroyItem'])
        ->name('cart-items.destroy');
});

Route::get('/orders/all', [OrderController::class, 'index'])->name('orders.index');
Route::resource('users.orders', OrderController::class)
    ->only(['index', 'store', 'update', 'destroy', 'edit', 'show']);
    // ->middleware('auth');
Route::get('/admin/orders/create', [OrderController::class, 'create'])->name('admin.orders.create');
Route::post('/admin/orders', [OrderController::class, 'adminStore'])->name('admin.orders.store');
Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');


// Route::get('/orders/{order}/checkout', [OrderController::class, 'checkout'])->name('orders.checkout')->middleware('auth');

// Route::get('/payments/all', [OrderController::class, 'allIndex'])->name('payments.index');
Route::resource('payments', PaymentController::class)->names('admin.payments');

Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard.index');

Route::get('/admin/payments/edit', function () {
    return view('admin.payments.edit');
})->name('admin.payments.edit');


Route::get('/carts/{cart}/view-checkout', [CheckoutController::class, 'viewCheckout'])->name('carts.view-checkout')->middleware('auth');

// pass an cart id and place order
Route::post('/carts/{cart}/checkout', [CheckoutController::class, 'checkout'])->name('carts.checkout')->middleware('auth');

// pass the order id
Route::get('/orders/{order}/pay', [CheckoutController::class, 'showPaymentPage'])->name('orders.pay')->middleware('auth');
Route::post('/orders/{order}/pay', [CheckoutController::class, 'processPayment'])->name('orders.process-payment')->middleware('auth');

Route::get('payment/khalti/callback', [CheckoutController::class, 'khaltiCallback'])->name('payment.khalti.callback');
Route::get('payment/{payment}/success', [CheckoutController::class, 'successUrl'])->name('payment.success');
Route::get('payment/{payment}/failure', [CheckoutController::class, 'failureUrl'])->name('payment.failure');


