<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $quantity = session('last_quantity', 1); // default to 1

        return view('product-detail', compact('product', 'quantity'));
    }



    public function updateQuantity($id)
    {
        $key = "quantity_$id";
        $quantity = session($key, 1);

        if (request('action') === 'increase') {
            $quantity++;
        } elseif (request('action') === 'decrease' && $quantity > 1) {
            $quantity--;
        }

        session([$key => $quantity]);

        return redirect()->back();
    }

}
