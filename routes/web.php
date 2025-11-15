<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController as ControllersProductController;
use App\Http\Controllers\UserController;
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

Route::get('/admin/orders', function () {
    return view('admin.orders.index');
})->name('admin.orders.index');

Route::get('/admin/payments', function () {
    return view('admin.payments.index');
})->name('admin.payments.index');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard.index');
})->name('admin.dashboard.index');

Route::get('/admin/orders/create', function () {
    return view('admin.orders.create');
})->name('admin.orders.create');

Route::get('/admin/payments/create', function () {
    return view('admin.payments.create');
})->name('admin.payments.create');

// Route::get('/admin/products/edit', function () {
//     return view('admin.products.edit');
// })->name('admin.products.edit');

Route::get('/admin/orders/edit', function () {
    return view('admin.orders.edit');
})->name('admin.orders.edit');

Route::get('/admin/payments/edit', function () {
    return view('admin.payments.edit');
})->name('admin.payments.edit');

Route::get('/admin/addresses', function () {
    return view('admin.addresses.index');
})->name('admin.addresses.index');
