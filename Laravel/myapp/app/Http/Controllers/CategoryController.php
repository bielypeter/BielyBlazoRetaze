<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show($name)
    {
        $category = Category::where('name', $name)->firstOrFail();

        $products = $category->products()
            ->when(request('min'), fn($q) => $q->where('price', '>=', request('min')))
            ->when(request('max'), fn($q) => $q->where('price', '<=', request('max')))
            ->when(request('brand'), fn($q) => $q->whereIn('brand', request('brand')))
            ->when(request('color'), fn($q) => $q->whereIn('color', request('color')))
            ->when(request('sort'), function ($q) {
                match (request('sort')) {
                    'name' => $q->orderBy('name'),
                    'price_asc' => $q->orderBy('price', 'asc'),
                    'price_desc' => $q->orderBy('price', 'desc'),
                    default => null,
                };
            })
            ->with('categories')
            ->paginate(6)
            ->appends(request()->query());
        return view('category', compact('category', 'products'));
    }
}
