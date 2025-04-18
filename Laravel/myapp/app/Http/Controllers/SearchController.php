<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $products = Product::where('name', 'ILIKE', "%{$query}%")
            ->orWhere('description', 'ILIKE', "%{$query}%")
            ->with('categories')
            ->paginate(6)
            ->appends(['q' => $query]);

        // Fake category ig? Blade didnt want to work without it
        $category = (object)[
            'name' => "Search results for \"{$query}\""
        ];

        return view('category', compact('products', 'category'));
    }
}
