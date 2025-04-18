<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/login', 'login');
Route::view('/register', 'register');
Route::view('/category', 'category');
Route::view('/category-admin', 'category-admin');
Route::view('/checkout', 'checkout');
Route::view('/product-detail', 'product-detail');
Route::view('/product-detail-admin', 'product-detail-admin');



use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



use App\Http\Controllers\CategoryController;

Route::get('/category/{name}', [CategoryController::class, 'show'])->name('category.show');



use App\Http\Controllers\SearchController;

Route::get('/search', [SearchController::class, 'index'])->name('search');



use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);