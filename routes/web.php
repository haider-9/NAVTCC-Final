<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/employees', [PageController::class, 'employees'])->name('employees.index');
Route::get('/products', [PageController::class, 'products'])->name('products.index');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery.index');
Route::get('/news', [PageController::class, 'news'])->name('news.index');
Route::get('/contact', [PageController::class, 'contact'])->name('contact.index');
