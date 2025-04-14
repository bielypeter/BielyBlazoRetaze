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
