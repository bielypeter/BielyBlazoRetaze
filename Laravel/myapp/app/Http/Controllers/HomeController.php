<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::with('categories')->inRandomOrder()->take(12)->get(); // get 12 random products, can also use latest or predefined ones, but i prefer random
        return view('home', compact('products'));
    }
}
