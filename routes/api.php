<?php

use App\Http\Controllers\Api\ContactInquiryController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductController::class)->names([
    'index' => 'api.products.index',
    'store' => 'api.products.store',
    'show' => 'api.products.show',
    'update' => 'api.products.update',
    'destroy' => 'api.products.destroy',
]);

Route::apiResource('employees', EmployeeController::class)->names([
    'index' => 'api.employees.index',
    'store' => 'api.employees.store',
    'show' => 'api.employees.show',
    'update' => 'api.employees.update',
    'destroy' => 'api.employees.destroy',
]);

Route::apiResource('gallery', GalleryController::class)->names([
    'index' => 'api.gallery.index',
    'store' => 'api.gallery.store',
    'show' => 'api.gallery.show',
    'update' => 'api.gallery.update',
    'destroy' => 'api.gallery.destroy',
]);

Route::apiResource('news', NewsController::class)->names([
    'index' => 'api.news.index',
    'store' => 'api.news.store',
    'show' => 'api.news.show',
    'update' => 'api.news.update',
    'destroy' => 'api.news.destroy',
]);

Route::post('contact-inquiries', [ContactInquiryController::class, 'store'])->name('api.contact-inquiries.store');
