<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Scan public/assets/products/ for all image files becasue im lazy to add singular ones
        $imageFiles = collect(File::files(public_path('assets/products')))
            ->map(fn($file) => $file->getFilename())
            ->toArray();

        $brands = ['Razer', 'Trust', 'HyperX', 'Keychron'];
        $colors = ['Red', 'Green', 'Turquise', 'Cyan'];

        $categories = Category::all();

        foreach ($categories as $category) {
            for ($i = 1; $i <= 20; $i++) {
                $image = collect($imageFiles)->random();
                $brand = collect($brands)->random();
                $color = collect($colors)->random();

                $product = Product::create([
                    'name' => "{$category->name} Product {$i}",
                    'description' => "Sample {$category->name} product number {$i}.",
                    'price' => rand(20, 200),
                    'image_path' => json_encode([$image]),
                    'color' => $color,
                    'brand' => $brand,
                ]);

                $product->categories()->attach($category->id);
            }
        }
    }
}
