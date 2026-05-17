<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\GalleryItem;
use App\Models\NewsItem;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home', [
            'productCount' => Product::count(),
            'featuredProducts' => Product::query()->where('is_featured', true)->latest()->take(3)->get(),
            'employeeCount' => Employee::count(),
            'departmentCount' => Employee::query()->distinct('department')->count('department'),
            'newsCount' => NewsItem::query()->where('is_published', true)->count(),
            'latestNews' => NewsItem::query()->where('is_published', true)->latest('published_at')->take(3)->get(),
        ]);
    }

    public function employees(): View
    {
        return view('pages.employees', [
            'employees' => Employee::query()->orderBy('department')->orderBy('full_name')->get(),
        ]);
    }

    public function products(): View
    {
        return view('pages.products');
    }

    public function gallery(): View
    {
        return view('pages.gallery', [
            'galleryItems' => GalleryItem::query()->where('is_published', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function news(): View
    {
        return view('pages.news', [
            'newsItems' => NewsItem::query()->where('is_published', true)->latest('published_at')->get(),
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact');
    }
}
