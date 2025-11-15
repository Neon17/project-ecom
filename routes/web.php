<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('admin/products', ProductController::class)->names('admin.products');
Route::resource('/admin/categories', CategoryController::class)->names('admin.categories');


Route::get('/admin/orders', function () {
    return view('admin.orders.index');
})->name('admin.orders.index');

Route::get('/admin/users', function () {
    return view('admin.users.index');
})->name('admin.users.index');

Route::get('/admin/payments', function () {
    return view('admin.payments.index');
})->name('admin.payments.index');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard.index');
})->name('admin.dashboard.index');



Route::get('/admin/orders/create', function () {
    return view('admin.orders.create');
})->name('admin.orders.create');

Route::get('/admin/users/create', function () {
    return view('admin.users.create');
})->name('admin.users.create');

Route::get('/admin/payments/create', function () {
    return view('admin.payments.create');
})->name('admin.payments.create');

// Route::get('/admin/products/edit', function () {
//     return view('admin.products.edit');
// })->name('admin.products.edit');

Route::get('/admin/orders/edit', function () {
    return view('admin.orders.edit');
})->name('admin.orders.edit');

Route::get('/admin/users/edit', function () {
    return view('admin.users.edit');
})->name('admin.users.edit');

Route::get('/admin/payments/edit', function () {
    return view('admin.payments.edit');
})->name('admin.payments.edit');

Route::get('/admin/addresses', function () {
    return view('admin.addresses.index');
})->name('admin.addresses.index');

Route::get('/admin/users/show', function () {
    return view('admin.users.show');
})->name('admin.users.show');
