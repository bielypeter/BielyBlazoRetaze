<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function show($id)
{
    $product = Product::findOrFail($id);

    $quantity = 1;

    return view('product-detail', compact('product', 'quantity'));
}





    public function updateQuantity(Request $request, $id)
        {
            $current = (int) $request->input('quantity', 1);
            $action = $request->input('action');
        
            if ($action === 'increment') {
                $current++;
            } elseif ($action === 'decrement') {
                $current = max(1, $current - 1);
            }
        
            session(['product_quantity_' . $id => $current]);
        
            return redirect()->route('product.detail', $id);
        }

}
