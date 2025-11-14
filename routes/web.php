<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/products', function () {
    return view('admin.products.index');
})->name('admin.products.index');

Route::get('/admin/categories', function () {
    return view('admin.categories.index');
})->name('admin.categories.index');

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


Route::get('/admin/products/create', function () {
    return view('admin.products.create');
})->name('admin.products.create');

Route::get('/admin/categories/create', function () {
    return view('admin.categories.create');
})->name('admin.categories.create');

Route::get('/admin/orders/create', function () {
    return view('admin.orders.create');
})->name('admin.orders.create');

Route::get('/admin/users/create', function () {
    return view('admin.users.create');
})->name('admin.users.create');

Route::get('/admin/payments/create', function () {
    return view('admin.payments.create');
})->name('admin.payments.create');


Route::get('/admin/products/edit', function () {
    return view('admin.products.edit');
})->name('admin.products.edit');

Route::get('/admin/categories/edit', function () {
    return view('admin.categories.edit');
})->name('admin.categories.edit');

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
    return view('admin.address.index');
})->name('admin.address.index');


