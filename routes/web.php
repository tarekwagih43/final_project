<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrdersProductsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('/');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/add', [CategoryController::class, 'add_form'])->name('categories.add');
Route::post('/categories/add', [CategoryController::class, 'add'])->name('categories.add');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit_form'])->name('categories.edit');
Route::put('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/add', [ProductController::class, 'add_form'])->name('products.add');
Route::post('/products/add', [ProductController::class, 'add'])->name('products.add');
Route::get('/products/{product}/edit', [ProductController::class, 'edit_form'])->name('products.edit');
Route::put('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

// Customers
Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
Route::get('/customers/add', [CustomerController::class, 'add_form'])->name('customers.add');
Route::post('/customers/add', [CustomerController::class, 'add'])->name('customers.add');
Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit_form'])->name('customers.edit');
Route::put('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

// Orders
Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::get('/orders/add', [OrderController::class, 'add_form'])->name('orders.add');
Route::post('/orders/add', [OrderController::class, 'add'])->name('orders.add');
Route::get('/orders/{product}/edit', [OrderController::class, 'edit_form'])->name('orders.edit');
Route::put('/orders/{product}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::delete('/orders/{product}', [OrderController::class, 'destroy'])->name('orders.destroy');

Route::get('/orders/{order}/view', [OrderController::class, 'view'])->name('orders.view');

// orders operations fetch route
Route::POST('/products/get_price', [ProductController::class, 'get_price'])->name('products.get_price');
Route::POST('/products/get_products', [ProductController::class, 'get_products_with_category'])->name('products.get_products');
Route::POST('/products/add_product', [OrdersProductsController::class, 'add_products_to_order'])->name('products.add_product');

Route::POST('/products/delete_product', [OrdersProductsController::class, 'delete_product_from_order'])->name('products.delete_product');

// Transactions
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
Route::POST('/transactions', [TransactionController::class, 'pay'])->name('transactions.pay');
Route::delete('/transactions/{product}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

// Auth
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/add', [UserController::class, 'add_form'])->name('users.add');
Route::post('/users/add', [UserController::class, 'add'])->name('users.add');
Route::get('/users/{user}/edit', [UserController::class, 'edit_form'])->name('users.edit');
Route::put('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

