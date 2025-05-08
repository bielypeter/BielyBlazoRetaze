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

        public function update(Request $request, $id)
        {
            $product = Product::findOrFail($id);
        
            $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
            ]);
        
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
            ]);
        
            return redirect()->back()->with('success', 'Product updated successfully.');
        }
        
        public function destroy($id)
        {
            $product = Product::findOrFail($id);
            $product->delete();
        
            return redirect('/')->with('success', 'Product deleted successfully.');
        }        

        public function uploadImages(Request $request, $id)
        {
            $product = Product::findOrFail($id);
            $images = json_decode($product->image_path ?? '[]', true);

            if ($request->hasFile('new_images')) {
                foreach ($request->file('new_images') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('assets/products'), $filename);
                    $images[] = $filename;
                }
                $product->image_path = json_encode($images);
                $product->save();
            }

            return redirect()->back()->with('success', 'Images uploaded.');
        }

        public function deleteImage($id, $index)
        {
            $product = \App\Models\Product::findOrFail($id);
            $images = json_decode($product->image_path ?? '[]', true);

            if (isset($images[$index])) {
                array_splice($images, $index, 1);
                $product->image_path = json_encode($images);
                $product->save();
            }

            return redirect()->back()->with('success', 'Image removed from product.');
        }
        public function store(Request $request, $categoryId)
        {
            $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'images' => 'required|array|min:2',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'brand' => 'nullable|string|in:Razer,Trust,HyperX,Keychron',
                'color' => 'nullable|string|in:Red,Green,Turquise,Cyan',
            ]);

            $filenames = [];
            foreach ($request->file('images') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/products'), $filename);
                $filenames[] = $filename;
            }

            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'brand' => $request->brand,
                'color' => $request->color,
                'image_path' => json_encode($filenames),
            ]);
            $product->categories()->attach($categoryId);
            return redirect()->back()->with('success', 'Product added!');
        }
}
